<?php

namespace App\Http\Livewire\Backend\Traits;

trait FormSubmission
{
    /**
     * Submit data to the Model.
     */
    public function submit()
    {
        $this->resetErrorBag();
        $this->bootValidationLabels();
        $error = $this->validate();

        // Start Transaction.
        \DB::beginTransaction();

        if (method_exists($this->model, 'beforeCreate')) {
            $this->model->beforeCreate($this->data);
        }

        try {
            $modelData = $this->model->create($this->data);
        } catch (\Exception $e) {
            \DB::rollback();

            return $this->emit('dispatchEvent', __('Error'), __('General Error[10001] Couldn\'t save data. Please contact CRM Administrator.'), 'error');
        }

        if (method_exists($this->model, 'afterCreate')) {
            if (true !== $postHook = $this->model->afterCreate($this->data, $modelData->id)) {
                \DB::rollback();

                return $this->emit('dispatchEvent', __('Error'), __('General Error[10001] Couldn\'t save data. Please contact CRM Administrator.'), 'error');
            }
        }

        // Finally commit everything.
        \DB::commit();

        return $this->emit('dispatchEvent', __('Success'), __('Succesfully added data.'), 'success');
    }
}
