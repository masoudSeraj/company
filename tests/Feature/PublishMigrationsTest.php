<?php

namespace Sunnyr\Company\Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublishMigrationsTest extends TestCase
{
    // use RefreshDatabase;
    public function test_migrations_can_exist_in_directory()
    {
        $databasePath = database_path('migrations');
        $path = base_path('\\packages\\company\\database\\migrations');

        $packageFiles = $this->findFiles($path);
        $rootFiles = $this->findFiles($databasePath);

        // get list of package migrations files
        $packageMigrations = array_map(function($file){
            $newFile = substr($file, 18);
            $result = substr($newFile, 0, -5);
            return $result;
        }, $packageFiles);


        // migration files which are there before test vendor publish is performed
        // we get these files in order to protect them from deleting published files
        // at the end of the test
        $filesToKeep = array_filter($rootFiles, function($rootFile) use($packageMigrations){
            $newFile = substr($rootFile, 18);
            $rootFile = substr($newFile, 0);

            $packageMigrations = array_filter($packageMigrations, function($packageMigration) use($rootFile){
                return str_contains($rootFile, $packageMigration);
            });
            return $packageMigrations;
        });
        
        Artisan::call('vendor:publish', [
            '--tag'   =>  'company-migrations'
        ]);
        
        // get current root migration files eg: create_products_table.php
        $rootFiles = $this->findFiles($databasePath);

        $rootMigrations = array_map(function($file){
            $newFile = substr($file, 18);
            $result = substr($newFile, 0);
            return $result;
        }, $rootFiles);

        // check if package migration is added to root migration directory
        $result = collect($packageMigrations)->every(function($packageMigration) use($rootMigrations){
            return in_array($packageMigration, $rootMigrations);
        });

        $this->assertTrue($result);

        // remove package migrations
        // get all root files after publish migrations again
        $allfiles = array_filter($rootFiles, function($file) use($packageMigrations){
            $newFile = substr($file, 18);
            $file = substr($newFile, 0);

            $packageMigrations = array_filter($packageMigrations, function($packageMigration) use($file){
                return str_contains($file, $packageMigration);
            });
            return $packageMigrations;
        });

        // only get the files which are not in $filesToKeep array
        $filesToDelete = array_diff_key($allfiles, $filesToKeep);

        // delete all recently created files
        foreach ($filesToDelete as $file) {
            unlink(database_path('\\migrations\\').$file);
        }
    }

    protected function findFiles($path)
    {
        return array_values(array_diff( scandir($path), array(".", "..") ));
    }
}
