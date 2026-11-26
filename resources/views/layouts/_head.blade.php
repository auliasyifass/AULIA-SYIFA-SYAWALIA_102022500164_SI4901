    {{-- Tailwind CDN + mode gelap pakai class (sama seperti project sistem-venue) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: { DEFAULT: '#173b6c', hover: '#254f85', soft: '#2b5287' },
                    },
                },
            },
        }
    </script>
    <style>
        * {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }
        html.dark { color-scheme: dark; }
    </style>
    <script>
        // Default gelap; kalau user pernah pilih terang, pakai terang
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.remove('dark');
        } else {
            document.documentElement.classList.add('dark');
        }

        function toggleTheme() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }
    </script>