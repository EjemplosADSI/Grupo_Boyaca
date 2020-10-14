<?php

namespace App\Providers;

use Form;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('eButton', 'components.form.button', ['id', 'name', 'attributes' => []]);
        Form::component('eButtonLink', 'components.form.buttonLink', ['id', 'name', 'attributes' => []]);
        Form::component('eCheckBox', 'components.form.checkbox', ['id', 'name', 'attributes' => []]);
        Form::component('eDatePickerFlatpickr', 'components.form.datepickerFlatpickr', ['id', 'name', 'attributes' => []]);
        Form::component('eDropzoneUpload', 'components.form.dropzone', ['id', 'name', 'attributes' => []]);
        Form::component('eMailAddress', 'components.form.email', ['id', 'name', 'attributes' => []]);
        Form::component('eNumber', 'components.form.number', ['id', 'name', 'attributes' => []]);
        Form::component('ePassword', 'components.form.password', ['id', 'name', 'attributes' => []]);
        Form::component('eSelect2', 'components.form.select2', ['id', 'name', 'options', 'hasKeys', 'attributes' => []]);
        Form::component('eText', 'components.form.text', ['id', 'name', 'attributes' => []]);
        Form::component('eTextArea', 'components.form.textArea', ['id', 'name', 'rows', 'value', 'attributes' => []]);
    }
}
