<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

uses(Tests\TestCase::class, DatabaseMigrations::class)->in('Feature');
