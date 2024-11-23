<?php

use Core\Container;

test('it can resolve something out of container', function () {
    // Arrange
    $container = new Container();

    $container->bind('foo', fn() => 'bar');

    // Act
    $result = $container->resolve('foo');

    // Assert/Expect
    expect($result)->toEqual('bar');
});
