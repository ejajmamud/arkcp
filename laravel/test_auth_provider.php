<?php
require __DIR__ . '/vendor/autoload.php';

echo "Testing AuthServiceProvider usage...\n";

class FakeApp implements ArrayAccess
{
    public function offsetExists($offset): bool
    {
        return true;
    }
    public function offsetGet($offset): mixed
    {
        return null;
    }
    public function offsetSet($offset, $value): void
    {
    }
    public function offsetUnset($offset): void
    {
    }
}

try {
    $app = new FakeApp();
    echo "Creating provider...\n";
    $provider = new Illuminate\Auth\AuthServiceProvider($app);
    echo "Provider created successfully.\n";
} catch (Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
