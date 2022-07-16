<?php

namespace App\Models\Backend\Lib;

/**
 * Trait Extensions.
 */
trait Extensions
{
    /**
     * @return array
     */
    public static function getFieldColumns()
    {
        return array_keys(self::getFieldData());
    }

    /**
     * @return null
     */
    public function saveMetaData($from, $to, $meta, $data = null)
    {
        if (isset($this->saveData[$meta])) {
            $metaData = [];
            foreach ($this->saveData[$meta] as $individualDataTuple) {
                $metaDataModel = new $from();
                $savedRowID = $metaDataModel->create($individualDataTuple)->id;
                $metaDataTuple = [
                    'from' => $this->savedModel,
                    'to' => $savedRowID,
                    'meta' => $meta,
                ];

                if (is_array($data)) {
                    foreach ($data as $field => $modelAssociation) {
                        if (isset($individualDataTuple[$field])) {
                            $fillData = [];
                            foreach ($individualDataTuple[$field] as $individualRowID) {
                                $fillData[] = [
                                    'from' => $savedRowID,
                                    'to' => $individualRowID,
                                    'meta' => $field,
                                ];
                            }

                            $modelAssociationInit = new $modelAssociation();
                            if (! $modelAssociationInit->insert($fillData)) {
                                throw 'Not inserted correctly.';
                            }
                        }
                    }
                }

                $metaData[] = $metaDataTuple;
            }

            $metaInsertedData = new $to();
            if (! $metaInsertedData->insert($metaData)) {
                throw 'Not inserted correctly.';
            }

            return $metaData;
        }
    }

    /**
     * @return array
     */
    public static function getFormLayout()
    {
        if (property_exists(self::class, 'formLayout')) {
            return self::$formLayout;
        } else {
            return [
                0 => array_keys(
                    self::getFieldData()
                ),
            ];
        }
    }

    /**
     * @return array
     */
    public static function getCanonicalName()
    {
        return self::$modelNameCanonical;
    }

    /**
     * @return array
     */
    public static function getPermissions()
    {
        $canonical = self::$modelNameSlug;

        return [
            'create' => "admin.$canonical.create",
            'read' => "admin.$canonical.read",
            'update' => "admin.$canonical.update",
            'delete' => "admin.$canonical.delete",
        ];
    }

    /**
     * @return array
     */
    public static function getTableColumns()
    {
        if (property_exists(self::class, 'tableColumns')) {
            return self::$tableColumns;
        } else {
            return [];
        }
    }
}
