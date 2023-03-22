<?php

declare(strict_types=1);

use function Pest\Laravel\get;

it(description:'can have a home page', function (){
  \Pest\Laravel\get(
    uri:route(name:'homepage'),
  )
        ->assertStatus(status:200)
        ->assertSee(text:'Laravel');
});
