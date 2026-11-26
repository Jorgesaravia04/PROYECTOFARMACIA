<?php

namespace Tests\Feature;

use Tests\TestCase;

class PwaFeatureTest extends TestCase
{
    public function test_pwa_resources_are_available(): void
    {
        foreach ([
            'manifest.json',
            'sw.js',
            'offline.html',
            'js/pwa.js',
            'icons/icon-192.png',
            'icons/icon-512.png',
        ] as $resource) {
            $this->assertFileExists(public_path($resource));
        }
    }

    public function test_manifest_contains_the_required_pwa_configuration(): void
    {
        $manifest = json_decode(file_get_contents(public_path('manifest.json')), true);

        $this->assertSame('./', $manifest['start_url']);
        $this->assertSame('standalone', $manifest['display']);
        $this->assertCount(2, $manifest['icons']);
        $this->assertSame('192x192', $manifest['icons'][0]['sizes']);
        $this->assertSame('512x512', $manifest['icons'][1]['sizes']);

        foreach ($manifest['icons'] as $icon) {
            $this->assertFileExists(public_path($icon['src']));
            $dimensions = getimagesize(public_path($icon['src']));
            $this->assertIsArray($dimensions);
        }
    }

    public function test_authenticated_layout_includes_pwa_metadata(): void
    {
        $this->assertStringContainsString(
            'manifest.json',
            file_get_contents(resource_path('views/partials/pwa-head.blade.php')),
        );
        $this->assertStringContainsString(
            'sw.js',
            file_get_contents(resource_path('views/partials/pwa-head.blade.php')),
        );
        $this->assertStringContainsString(
            'data-pwa-install',
            file_get_contents(resource_path('views/template/administrador.blade.php')),
        );
    }
}
