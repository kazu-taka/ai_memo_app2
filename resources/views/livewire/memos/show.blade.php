<?php

use function Livewire\Volt\{state, mount};
use App\Models\Memo;

state(['memo' => null]);

mount(function (Memo $memo) {
    $this->memo = $memo;
});

$delete = function () {
    $this->memo->delete();
    session()->flash('status', 'メモを削除しました。');
    $this->redirect(route('memos.index'), navigate: true);
};

?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">{{ $memo->title }}</h1>
                <div class="text-sm text-gray-500 mb-4">
                    作成日: {{ $memo->created_at->format('Y年m月d日 H:i') }}
                </div>
                <div class="whitespace-pre-wrap">{{ $memo->body }}</div>
                <div class="mt-4 flex items-center gap-4">
                    <x-secondary-button tag="a" href="{{ route('memos.edit', $memo) }}" wire:navigate>
                        編集
                    </x-secondary-button>
                    <x-secondary-button tag="a" href="{{ route('memos.index') }}" wire:navigate>
                        戻る
                    </x-secondary-button>
                    <x-danger-button wire:click="delete" wire:confirm="本当にこのメモを削除しますか？">
                        削除
                    </x-danger-button>
                </div>
            </div>
        </div>
    </div>
</div>
