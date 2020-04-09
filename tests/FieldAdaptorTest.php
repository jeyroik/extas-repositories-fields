<?php

use PHPUnit\Framework\TestCase;
use extas\components\repositories\FieldAdaptorPlugin;
use extas\components\repositories\FieldAdaptor;
use extas\components\Item;

/**
 * Class PluginUuidFieldTest
 *
 * @author jeyroik <jeyroik@gmail.com>
 */
class FieldAdaptorTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $env = \Dotenv\Dotenv::create(getcwd() . '/tests/');
        $env->load();
    }

    public function testApply()
    {
        $adaptor = new class() extends FieldAdaptorPlugin {
            protected function getMarkers()
            {
                return [
                    new class () extends FieldAdaptor {
                        function apply(string $value)
                        {
                            return 'ok';
                        }

                        function isApplicable(string $value): bool
                        {
                            return $value == 'test';
                        }
                    }
                ];
            }
        };

        $item = new class ([
            'test_status' => 'test',
            'multi_level' => [
                'sub_level' => 'test'
            ]
        ]) extends Item {
            protected function getSubjectForExtension(): string
            {
                return '';
            }
        };

        $adaptor($item);
        $this->assertEquals(
            [
                'test_status' => 'ok',
                'multi_level' => [
                    'sub_level' => 'ok'
                ]
            ],
            $item->__toArray()
        );
    }
}
