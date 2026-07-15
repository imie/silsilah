<?php

$dir = new RecursiveDirectoryIterator(__DIR__ . '/tests');
$iterator = new RecursiveIteratorIterator($dir);

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getRealPath());

        // Replace /** @test */ and rename method
        $content = preg_replace_callback(
            '/\/\*\*\s*@test\s*\*\/\s*public\s+function\s+([a-zA-Z0-9_]+)/s',
            function ($matches) {
                $methodName = $matches[1];
                if (strpos($methodName, 'test') !== 0) {
                    $methodName = 'test_' . $methodName;
                }
                return "public function {$methodName}";
            },
            $content
        );

        // Replace /** @test @dataProvider ... */
        $content = preg_replace_callback(
            '/\/\*\*\s*\*\s*@test\s*\*\s*@dataProvider\s+([a-zA-Z0-9_]+)\s*\*\/\s*public\s+function\s+([a-zA-Z0-9_]+)/s',
            function ($matches) {
                $providerName = $matches[1];
                $methodName = $matches[2];
                if (strpos($methodName, 'test') !== 0) {
                    $methodName = 'test_' . $methodName;
                }
                return "/**\n     * @dataProvider {$providerName}\n     */\n    public function {$methodName}";
            },
            $content
        );


        // Replace factory(Model::class)->create()
        $content = preg_replace(
            '/factory\((User|Couple|UserMetadata)::class\)->/',
            '$1::factory()->',
            $content
        );

        // Replace factory(App\Model::class)->create()
        $content = preg_replace(
            '/factory\(App\\\\(User|Couple|UserMetadata)::class\)->/',
            'App\\\\$1::factory()->',
            $content
        );
        
        // Replace factory(Model::class, $count)->
        $content = preg_replace(
            '/factory\((User|Couple|UserMetadata)::class,\s*(\d+)\)->/',
            '$1::factory()->count($2)->',
            $content
        );

        // Replace states('male') with male()
        $content = preg_replace(
            '/->states\(\'([a-zA-Z0-9_]+)\'\)->/',
            '->$1()->',
            $content
        );

        file_put_contents($file->getRealPath(), $content);
    }
}

echo "Refactored tests.\n";
