<?php

namespace Yeelight\Generators\Commands;

use Illuminate\Support\Collection;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Yeelight\Generators\FileAlreadyExistsException;
use Yeelight\Generators\MigrationGenerator;
use Yeelight\Generators\ModelGenerator;
use Yeelight\Generators\RepositoryEloquentGenerator;
use Yeelight\Generators\RepositoryInterfaceGenerator;

/**
 * Class RepositoryCommand
 *
 * @category Yeelight
 *
 * @package Yeelight\Generators\Commands
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class RepositoryCommand extends CommandBase
{
    /**
     * The name of command.
     *
     * @var string
     */
    protected $name = 'yl:repository';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create a new repository.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * $generators
     *
     * @var Collection
     */
    protected $generators = null;

    /**
     * Execute the command.
     *
     * @return void
     */
    public function fire()
    {
        $this->generators = new Collection();

        $this->generators->push(
            new MigrationGenerator(
                [
                    'name' => 'create_' . snake_case(str_plural($this->argument('name'))) . '_table',
                    'fields' => $this->option('fillable'),
                    'force' => $this->option('force'),
                ]
            )
        );

        $modelGenerator = new ModelGenerator(
            [
                'name' => $this->argument('name'),
                'fillable' => $this->option('fillable'),
                'force' => $this->option('force'),
            ]
        );

        $this->generators->push($modelGenerator);

        $this->generators->push(
            new RepositoryInterfaceGenerator(
                [
                    'name' => $this->argument('name'),
                    'force' => $this->option('force'),
                ]
            )
        );

        foreach ($this->generators as $generator) {
            $generator->run();
        }

        $model = $modelGenerator->getRootNamespace().'\\'.$modelGenerator->getName();
        $model = str_replace(
            [
                '\\',
                '/',
            ],
            '\\',
            $model
        );

        try {
            (new RepositoryEloquentGenerator(
                [
                    'name' => $this->argument('name'),
                    'rules' => $this->option('rules'),
                    'fields' => $this->option('fields'),
                    'validator' => $this->option('validator'),
                    'presenter' => $this->option('presenter'),
                    'force' => $this->option('force'),
                    'model' => $model,
                ]
            ))->run();
            $this->info('Repository created successfully.');
        } catch (FileAlreadyExistsException $e) {
            $this->error($this->type.' already exists!');

            return false;
        }
    }

    /**
     * The array of command arguments.
     *
     * @return array
     */
    public function getArguments()
    {
        return [
            [
                'name',
                InputArgument::REQUIRED,
                'The name of class being generated.',
                null,
            ],
        ];
    }

    /**
     * The array of command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return [
            [
                'fillable',
                null,
                InputOption::VALUE_OPTIONAL,
                'The fillable attributes.',
                null,
            ],
            [
                'rules',
                null,
                InputOption::VALUE_OPTIONAL,
                'The rules of validation attributes.',
                null,
            ],
            [
                'fields',
                null,
                InputOption::VALUE_OPTIONAL,
                'The fields attributes.',
                null,
            ],
            [
                'validator',
                null,
                InputOption::VALUE_OPTIONAL,
                'Adds validator reference to the repository.',
                null,
            ],
            [
                'presenter',
                null,
                InputOption::VALUE_OPTIONAL,
                'Adds presenter reference to the repository.',
                null,
            ],
            [
                'force',
                'f',
                InputOption::VALUE_NONE,
                'Force the creation if file already exists.',
                null,
            ],
        ];
    }
}
