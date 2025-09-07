<?php

use function Livewire\Volt\{state, mount};
use App\Models\Memo;
use Illuminate\Support\Facades\Auth;

state(['memos' => []]);

mount(function () {
    $this->memos = Auth::user()->memos()->latest()->get();
});

?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-white to-gray-50 overflow-hidden shadow-lg sm:rounded-xl">
            <div class="p-8 text-gray-900">
                <div class="flex justify-between items-center mb-8">
                    <h1
                        class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">
                        メモ一覧</h1>
                    <x-primary-button tag="a" href="{{ route('memos.create') }}" wire:navigate
                        class="transform hover:scale-105 transition-transform duration-200 ease-in-out">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        新規作成
                    </x-primary-button>
                </div>

                @if ($memos->isEmpty())
                    <div class="flex flex-col items-center justify-center py-12 text-gray-500">
                        <svg class="w-16 h-16 mb-4 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <p class="text-lg">メモがありません</p>
                        <p class="mt-2">新規作成ボタンからメモを追加してください</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($memos as $memo)
                            <a href="{{ route('memos.show', $memo) }}"
                                class="group block p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 ease-in-out transform hover:-translate-y-1 border border-gray-100 hover:border-blue-100">
                                <div class="flex flex-col h-full">
                                    <h2
                                        class="text-xl font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-200 mb-2 line-clamp-2">
                                        {{ $memo->title }}
                                    </h2>
                                    <div class="mt-auto flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $memo->created_at->format('Y年m月d日') }}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
