import './bootstrap';

// ダークモードの初期設定
if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
} else {
    document.documentElement.classList.remove('dark');
}

// ダークモード切り替えイベントのリスナー
document.addEventListener('livewire:initialized', () => {
    Livewire.on('dark-mode-toggled', (event) => {
        if (event.darkMode) {
            document.documentElement.classList.add('dark');
            localStorage.theme = 'dark';
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.theme = 'light';
        }
    });
});
