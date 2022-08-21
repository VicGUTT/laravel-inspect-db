<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(string $connection): void
    {
        Schema::create('posts', static function (Blueprint $table) use ($connection): void {
            if ($connection !== 'sqlite') {
                $table->id()->startingValue(7);
            } else {
                $table->id();
            }

            $table->string('name')->index();
            $table->string('img')->default('fallback.jpg');
            $table->string('slug')->unique();
            $table->text('content');
            $table->smallInteger('reading_time')->unsigned()->comment('The amount of time it would take the average human to read the entire article in seconds.');

            switch ($connection) {
                case 'sqlite':
                    $table->text('yolo')->charset('latin1')->collation('latin1_swedish_ci')->nullable();

                    break;
                case 'pgsql':
                    $table->text('yolo')->fulltext('custom_fulltext_index_name')->charset('latin1')->collation('und-x-icu')->nullable();

                    break;
                default:
                    $table->text('yolo')->fulltext('custom_fulltext_index_name')->charset('latin1')->collation('latin1_swedish_ci')->nullable();

                    break;
            }

            $table->string('excerpt', 160)->nullable();
            $table->boolean('validated')->default(false)->comment('Whether or not the given post has been validated by an admin user.');
            $table->boolean('draft')->default(true)->comment('Whether or not the given post is in "draft" mode.');
            $table->timestamp('published_at')->useCurrent();
            $table->timestamp('draft_updated_at')->useCurrentOnUpdate();

            $table->foreignId('user_id')->constrained();

            $table->timestamps();

            $table->comment('This is the posts table');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
