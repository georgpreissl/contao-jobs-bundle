<?php

namespace GeorgPreissl\Jobs;

use Model;

/**
 * Class CdModel
 *
 * Reads and writes CDs.
 */
class JobsModel extends Model
{

    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_jobs';
}
