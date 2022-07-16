<?php

namespace App\Http\Livewire\Backend\Traits;

trait FormComponentTraits
{

    /**
     * @return array
     */
    protected function rules()
    {
        $rules = [];

        foreach ($this->fields as $key => $value) {
            if (isset($value['validation'])) {
                $rules["data.$key"] = $value['validation'];
            }
        }

        return $rules;
    }

    /**
     * Initialize form fields, populate data.
     */
    private function initializeField()
    {
        if ($this->model) {
            $this->fields = $this->model->getFieldData();
            $this->columns = $this->model->getFieldColumns();
            $this->formLayout = $this->model->getFormLayout();
            $this->firstTabHeader = false;
            $this->firstTabContent = false;
        }

        $this->initializeFieldSetInstance();
    }

    public function initializeFieldSetInstance()
    {
        $this->data = [];
        $this->data = array_fill_keys($this->columns, null);
    }

    /**
     * Human readable Validation messages.
     */
    protected function bootValidationLabels()
    {
        foreach ($this->fields as $key => $value) {
            $this->validationAttributes["data.$key"] = $value['label'];
        }
    }

    /**
     * Validate only the selected attribute.
     */
    public function updated($propertyName)
    {
        $this->bootValidationLabels();
        $this->validateOnly($propertyName);
    }

    private function sessionFlash($type = 'error', $message = 'An error occured, please contact support.')
    {
        return session()->flash($type, __($message));
    }

    public function updateSelectField($field, $value)
    {
        if (!in_array($field, $this->columns) || !isset($this->fields[$field]) || 'select' !== $this->fields[$field]['type']) {
            return;
        }

        if (null === $this->data[$field]) {
            if ( isset($fieldDataTuple['multiple']['affirm']) && $fieldDataTuple['multiple']['affirm'] ) {
                $this->data[$field] = [];
            } else {
                $this->data[$field] = null;
            }
        }

        if (isset($this->fields[$field]['multiple']) && is_array($this->fields[$field]['type']) && true === $this->fields[$field]['type']['affirm']) {
            $this->data[$field][] = array_values($value);
        } else {
            $this->data[$field] =  $value;
        }
    }

    public function updateTextAreaField($field, $value)
    {
        if (!in_array($field, $this->columns) || !isset($this->fields[$field]) || 'textarea' !== $this->fields[$field]['type']) {
            return;
        }

        $this->data[$field] = $value;
    }

    public function deleteTupleData($field, $index)
    {
        if ( ! isset($this->data[$field][$index])) {
            return;
        }

        unset( $this->data[$field][$index] );

        return $this->emit('dispatchEvent', __('Success'), __('The selected data set has been successfully cleared.'), 'info');

    }

    public function appendFileUpload($field, $fileHash)
    {
        if (!in_array($field, $this->columns)) {
            return;
        }
        if (null === $this->data[$field]) {
            $this->data[$field] = [];
            $this->data[$field][] = $fileHash;
        } else {
            $this->data[$field][] = $fileHash;
        }
    }

    public function removeFileUpload($field, $fileHash)
    {
        if (!in_array($field, $this->columns)) {
            return;
        }

        if (isset($this->data[$field]) && is_array($this->data[$field]) && ($needle = array_search($fileHash, $this->data[$field])) !== false) {
            unset($this->data[$field][$needle]);
        }
    }
}
