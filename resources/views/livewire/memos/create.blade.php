<?php

use function Livewire\Volt\{state, rules, computed};
use App\Models\Memo;

state([
    'title' => '',
    'body' => '',
]);

rules([
    'title' => ['required', 'string', 'max:50'],
    'body' => ['required', 'string', 'max:2000'],
]);

$save = function () {
    $validated = $this->validate();

    $memo = new Memo();
    $memo->user_id = auth()->id();
    $memo->title = $validated['title'];
    $memo->body = $validated['body'];
    $memo->save();

    session()->flash('status', 'メモを作成しました。');
    $this->redirect(route('memos.index'));
};

?>

<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-lg font-semibold mb-4">新規メモ作成</h2>

                <form wire:submit="save" class="space-y-6">
                    <div>
                        <x-input-label for="title" value="タイトル" />
                        <x-text-input wire:model="title" id="title" type="text" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="body" value="本文" />
                        <x-textarea wire:model="body" id="body" class="mt-1 block w-full" rows="10" />
                        <x-input-error :messages="$errors->get('body')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>保存</x-primary-button>
                        <x-secondary-button tag="a" href="{{ route('memos.index') }}">キャンセル</x-secondary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
