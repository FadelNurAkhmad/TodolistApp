<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            "user" => "parjo",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Parjo"
                ],
                [
                    "id" => "2",
                    "todo" => "Raharjo"
                ]
            ]
        ])->get("/todolist")
            ->assertSeeText("1")
            ->assertSeeText("Parjo")
            ->assertSeeText("2")
            ->assertSeeText("Raharjo");
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            "user" => "parjo"
        ])->post("/todolist", [])
            ->assertSeeText("Todo is required");
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            "user" => "parjo"
        ])->post("/todolist", [
            "todo" => "Raharjo"
        ])->assertRedirect("/todolist");
    }

    public function testRemoveTodolist()
    {
        $this->withSession([
            "user" => "parjo",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Parjo"
                ],
                [
                    "id" => "2",
                    "todo" => "Raharjo"
                ]
            ]
        ])->post("/todolist/1/delete")
            ->assertRedirect("/todolist");
    }
}
