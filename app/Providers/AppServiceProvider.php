<?php

namespace App\Providers;

use App\Menu;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

            $event->menu->add([
                'text' => 'search',
                'search' => true,
                'topnav' => true,
            ]);
            $event->menu->add([
                'text' => 'blog',
                'url'  => 'admin/blog',
                'can'  => 'manage-blog',
            ]);
            /*$event->menu->add([
                'text'        => 'pages',
                'url'         => 'admin/pages',
                'icon'        => 'far fa-fw fa-file',
                'label'       => 4,
                'label_color' => 'success',
            ]);*/

            $objMenu = Menu::where('parent_id', '=', NULL)->with('children','parent')->get()->sortBy('order');
            foreach ($objMenu as $CategoryLevelMenu){
                $event->menu->add([ 'header' => $CategoryLevelMenu->title]);
                if (!$CategoryLevelMenu->children->isEmpty()){
                    foreach($CategoryLevelMenu->children->sortBy('order') as $ModuleMenu){
                        $itemMenu = [
                            'text' => $ModuleMenu->title,
                            'url'  => $ModuleMenu->route,
                            'label'=> $ModuleMenu->label,
                            'label_color' => $ModuleMenu->label_color,
                            'icon' => $ModuleMenu->icon,
                            'icon_color' => $ModuleMenu->icon_color,
                        ];
                        if ( !$ModuleMenu->children->isEmpty() ){
                            foreach( $ModuleMenu->children->sortBy('order') as $SubMenu ){
                                $itemSubmenu = [
                                    'text' => $SubMenu->title,
                                    'url'  => $SubMenu->route,
                                    'label'=> $SubMenu->label,
                                    'label_color' => $SubMenu->label_color,
                                    'icon' => $SubMenu->icon,
                                    'icon_color' => $SubMenu->icon_color,
                                ];
                                $itemMenu['submenu'][] = $itemSubmenu ;
                            }
                        }
                        $event->menu->add($itemMenu);
                    }
                }
            }
        });
    }
}
