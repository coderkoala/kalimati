<?php

if (! function_exists('activeClass')) {
    /**
     * Get the active class if the condition is not falsy.
     *
     * @param  $condition
     * @param  string  $activeClass
     * @param  string  $inactiveClass
     * @return string
     */
    function activeClass($condition, $activeClass = 'active', $inactiveClass = '')
    {
        return $condition ? $activeClass : $inactiveClass;
    }
}

if (! function_exists('htmlLang')) {
    /**
     * Access the htmlLang helper.
     */
    function htmlLang()
    {
        return str_replace('_', '-', app()->getLocale());
    }
}

if (! function_exists('render_html')) {
    /**
     * Create an html component.
     */
    function render_html($fields, $values = [])
    {
        $html = '';

        foreach ($fields as $fieldName => $fieldDataTuple) {
            if (true === $fieldDataTuple['render']) {
                $html .= '<div class="form-group row">';
                $html .= '<label class="col-md-2 col-form-label" for="'.$fieldName.'">'.__($fieldDataTuple['label']).'</label>';
                $html .= '<div class="col-md-10">';
                switch ($fieldDataTuple['type']) {
                    case 'textarea':
                        if (isset($values[$fieldName]) && (strpos($fieldDataTuple['validation'], 'json') || ! is_string($values[$fieldName]))) {
                            $values[$fieldName] = json_encode($values[$fieldName], JSON_PRETTY_PRINT);
                        }

                        // Check if field is disabled.
                        if (true === $fieldDataTuple['disabled']) {
                            // Print as code instead of textarea.
                            $html .= '<div class="card text-white bg-secondary w-100"><div class="card-body"><code>'.(isset($values[$fieldName]) ? htmlspecialchars($values[$fieldName]) : '').'</code></div></div>';
                        } else {
                            $html .= '<textarea id="'.$fieldName.'" class="form-control" name="'.$fieldName.'" '.(true === $fieldDataTuple['required'] ? ' required="required" ' : '').(true === $fieldDataTuple['disabled'] ? ' disabled="disabled" ' : '').(true === $fieldDataTuple['hidden'] ? ' hidden="hidden" ' : '').(isset($values[$fieldName]) ? '>'.$values[$fieldName] : '>').'</textarea>';
                        }

                        break;
                    case 'select':
                        $html .= '<select class="form-control" name="'.$fieldName.'" '.(true === $fieldDataTuple['required'] ? ' required="required" ' : '').(true === $fieldDataTuple['disabled'] ? ' disabled="disabled" ' : '').(true === $fieldDataTuple['hidden'] ? ' hidden="hidden" ' : '').'>';
                        $html .= '<option '.(isset($values[$fieldName]) ? '' : ' selected="selected" disabled').'>'.__($fieldDataTuple['label']).'</option>';

                        // If the model is a string, then it is a class name.
                        if (is_string($fieldDataTuple['model'])) {
                            foreach ($fieldDataTuple['model']::all() as $tuple) {
                                $html .= '<option value="'.$tuple->id.'"'.(isset($values[$fieldName]) && $values[$fieldName] === $tuple->id ? ' selected="selected" ' : '').'>'.__($tuple->name).'</option>';
                            }
                        } else {
                            foreach (collect($fieldDataTuple['model']) as $key => $value) {
                                $html .= '<option value="'.$key.'"'.(isset($values[$fieldName]) && $values[$fieldName] === $key ? ' selected="selected" ' : '').'>'.__($value).'</option>';
                            }
                        }
                        $html .= '</select>';
                        break;
                    case 'commodity':
                        $html .= '<select class="form-control" name="'.$fieldName.'" '.(true === $fieldDataTuple['required'] ? ' required="required" ' : '').(true === $fieldDataTuple['disabled'] ? ' disabled="disabled" ' : '').(true === $fieldDataTuple['hidden'] ? ' hidden="hidden" ' : '').'>';
                        $html .= '<option '.(isset($values[$fieldName]) ? '' : ' selected="selected" disabled').'>'.$fieldDataTuple['label'].'</option>';
                        foreach ($fieldDataTuple['model']::all() as $tuple) {
                            $html .= '<option value="'.$tuple->commodity_id.'"'.(isset($values[$fieldName]) && $values[$fieldName] === $tuple->commodity_id ? ' selected="selected" ' : '').'>'.$tuple->{'commodity_'.app()->getLocale()}.'</option>';
                        }
                        $html .= '</select>';
                        break;
                    case 'json':
                        $html .= '<div class="card text-white bg-secondary w-100" style="max-width: 18rem;"><div class="card-body"><code>'.(isset($values[$fieldName]) ? htmlspecialchars(json_encode($values[$fieldName], JSON_PRETTY_PRINT)) : '').'</code></div></div>';
                        break;
                    case 'text-div':
                        $html .= '<div class="card text-white bg-secondary w-100" style="max-width: 18rem;"><div class="card-body">'.(isset($values[$fieldName]) ? htmlspecialchars(json_encode($values[$fieldName], JSON_PRETTY_PRINT)) : '').'</div></div>';
                        break;
                    case 'date':
                        $value = $fieldDataTuple['value'] ?? '';
                        $value = empty($values[$fieldName]) ? $value : date('Y-m-d', strtotime($values[$fieldName]));
                        $html .= '<input type="'.$fieldDataTuple['type'].'" class="form-control" name="'.$fieldName.'" '.(true === $fieldDataTuple['required'] ? ' required="required" ' : '').(true === $fieldDataTuple['disabled'] ? ' disabled="disabled" ' : '').(true === $fieldDataTuple['hidden'] ? ' hidden="hidden" ' : '').' value="'.$value.'"/>';
                        break;
                    default:
                        $value = $fieldDataTuple['value'] ?? null;
                        $value = $values[$fieldName] ?? $value;
                        $html .= '<input type="'.$fieldDataTuple['type'].'" class="form-control" name="'.$fieldName.'" '.(true === $fieldDataTuple['required'] ? ' required="required" ' : '').(true === $fieldDataTuple['disabled'] ? ' disabled="disabled" ' : '').(true === $fieldDataTuple['hidden'] ? ' hidden="hidden" ' : '').' value="'.$value.'"/>';
                }
                // Check if $fieldDataTuple has key 'warning'. If it does, print a bootstrap alert with the text.
                if (isset($fieldDataTuple['warning'])) {
                    $html .= '<div class="alert alert-warning mt-3" role="alert">'.__($fieldDataTuple['warning']).'</div>';
                }
                $html .= '</div></div>';
            }
        }

        return $html;
    }
}
