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
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">メモ一覧</h1>

                @if ($memos->isEmpty())
                    <p class="text-gray-500">メモがありません。</p>
                @else
                    <div class="space-y-2">
                        @foreach ($memos as $memo)
                            <div class="border-b pb-2">
                                <a href="{{ route('memos.show', $memo) }}"
                                    class="text-lg hover:text-blue-600 transition-colors duration-200">
                                    {{ $memo->title }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
