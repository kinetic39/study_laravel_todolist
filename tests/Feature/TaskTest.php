<?php

namespace Tests\Feature;

use App\Http\Requests\CreateTask;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 各テストメソッドの実行前に呼ばれる。
     */
    public function setUp() :void
    {
        parent::setUp();
        # code...

        $this->seed('FoldersTableSeeder');        
    }

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * 期限日が日付でない場合はバリデーションエラー
     * @test
     */
    public function due_date_should_be_date()
    {
        # code...
        $response = $this->post('/folders/1/tasks/create',[
            'title' => 'Sample task',
            'due_date' => 123,  // 不正な数値
        ]);

        $response->assertSessionHasErrors([
            'due_date' => '期限日 には日付を入力してください。'
        ]);
    }

    /**
     * 期限日が過去日付の場合にはバリデーションエラー
     * @test
     */
    public function due_date_should_not_be_past()
    {
        # code...
        $response = $this->post('/folders/1/tasks/create',[
            'title' => 'Sample task',
            'due_date' => Carbon::yesterday()->format('Y/m/d'),  // 不正なデータ
        ]);

        $response->assertSessionHasErrors([
            'due_date' => '期限日 には今日以降の日付を入力してください。'
        ]);
    }
}
