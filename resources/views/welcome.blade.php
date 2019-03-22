<!doctype html>
<html lang="{{ app()->getLocale() }}">

    <!-- This is top secret! -->

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <link href="{{ url('css/app.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ url('js/app.js') }}"></script>

        <script>
            window.Laravel = @json(['csrfToken' => csrf_token()]);

            window.AppURL = "{!! (url('/')) !!}";
        </script>

    </head>

    <body class="bg-black bg-hero m-0 p-0 w-full h-100vh block sm:flex sm:flex-col sm:items-center sm:justify-center text-center">

        <script type="text/template" id="chat-other">
            <div class="py-4 text-left flex items-start justify-start animated bounceInLeft">
                <div class="flex items-start">
                    <div class="inline-block w-0 h-0 mt-2 border-blue-lighter border-8 border-left-triangle"></div>
                    <p data-chat-text class="inline-block rounded m-0 p-4 bg-blue-lighter text-blue-darkest"></p>
                </div>
            </div>
        </script>

        <script type="text/template" id="chat-self">
            <div class="py-4 text-right flex items-end justify-end animated bounceInRight">
                <p data-chat-text class="inline-block rounded m-0 p-4 bg-green-lighter text-green-darkest"></p>
                <div class="inline-block w-0 h-0 mb-2 border-green-lighter border-8 border-right-triangle"></div>
            </div>
        </script>

        <aside class="px-1 sm:w-1/4" id="chat-messages"></aside>

        <main>

            <div id="greeting" class="hidden py-4">
                <div class="text-grey-lightest text-xl font-hairline">Hi, I'm</div>

                <h1 class="text-grey-lighter text-5xl font-extrabold tracking-wide">LIAM</h1>
            </div>

            <div id="tagline" class="text-grey-lightest font-hairline hidden py-4">
                <p>
                    <span id="greeting-small" class="hidden">Hi, I'm Liam.</span>
                    I work at <a href="https://futureplc.com/" class="text-grey no-underline hover:text-grey-lighter">Future Publishing</a> helping to build a publishing platform.
                </p>
                <p class="text-sm pt-2">I also make a lot of awful jokes. Sorry about that.</p>
            </div>


        </main>

        <footer class="flex items-center justify-center py-4">
            <a href="https://github.com/ImLiam" class="text-grey-darkest hover:text-github py-2 px-2 no-underline" data-balloon="GitHub" data-balloon-pos="down">
                <svg aria-hidden="true" alt="GitHub" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" class="w-8">
                    <path fill="currentColor" d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"></path>
                </svg>
            </a>

            <a href="https://twitter.com/LiamHammett" class="text-grey-darkest hover:text-twitter py-2 px-2 no-underline" data-balloon="Twitter" data-balloon-pos="down">
                <svg aria-hidden="true" alt="Twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-8">
                    <path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path>
                </svg>
            </a>

            <a href="https://medium.com/@liamhammett" class="text-grey-darkest hover:text-medium py-2 px-2 no-underline" data-balloon="Medium" data-balloon-pos="down">
                <svg aria-hidden="true" alt="Medium" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-8">
                    <path fill="currentColor" d="M0 32v448h448V32H0zm372.2 106.1l-24 23c-2.1 1.6-3.1 4.2-2.7 6.7v169.3c-.4 2.6.6 5.2 2.7 6.7l23.5 23v5.1h-118V367l24.3-23.6c2.4-2.4 2.4-3.1 2.4-6.7V199.8l-67.6 171.6h-9.1L125 199.8v115c-.7 4.8 1 9.7 4.4 13.2l31.6 38.3v5.1H71.2v-5.1l31.6-38.3c3.4-3.5 4.9-8.4 4.1-13.2v-133c.4-3.7-1-7.3-3.8-9.8L75 138.1V133h87.3l67.4 148L289 133.1h83.2v5z"></path>
                </svg>
            </a>

            <a href="mailto:liam@liamhammett.com" class="text-grey-darkest hover:text-grey-darker py-2 px-2 no-underline" data-balloon="E-mail" data-balloon-pos="down">
                <svg aria-hidden="true" alt="E-mail" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-8">
                    <path fill="currentColor" d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z" class=""></path>
                </svg>
            </a>

            <a href="https://dribbble.com/LiamHammett" class="text-grey-darkest hover:text-dribbble py-2 px-2 no-underline" data-balloon="Dribbble" data-balloon-pos="down">
                <svg aria-hidden="true" alt="Dribbble" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-8">
                    <path fill="currentColor" d="M256 8C119.252 8 8 119.252 8 256s111.252 248 248 248 248-111.252 248-248S392.748 8 256 8zm163.97 114.366c29.503 36.046 47.369 81.957 47.835 131.955-6.984-1.477-77.018-15.682-147.502-6.818-5.752-14.041-11.181-26.393-18.617-41.614 78.321-31.977 113.818-77.482 118.284-83.523zM396.421 97.87c-3.81 5.427-35.697 48.286-111.021 76.519-34.712-63.776-73.185-116.168-79.04-124.008 67.176-16.193 137.966 1.27 190.061 47.489zm-230.48-33.25c5.585 7.659 43.438 60.116 78.537 122.509-99.087 26.313-186.36 25.934-195.834 25.809C62.38 147.205 106.678 92.573 165.941 64.62zM44.17 256.323c0-2.166.043-4.322.108-6.473 9.268.19 111.92 1.513 217.706-30.146 6.064 11.868 11.857 23.915 17.174 35.949-76.599 21.575-146.194 83.527-180.531 142.306C64.794 360.405 44.17 310.73 44.17 256.323zm81.807 167.113c22.127-45.233 82.178-103.622 167.579-132.756 29.74 77.283 42.039 142.053 45.189 160.638-68.112 29.013-150.015 21.053-212.768-27.882zm248.38 8.489c-2.171-12.886-13.446-74.897-41.152-151.033 66.38-10.626 124.7 6.768 131.947 9.055-9.442 58.941-43.273 109.844-90.795 141.978z" class=""></path>
                </svg>
            </a>

            <a href="https://stackoverflow.com/users/3175119" class="text-grey-darkest hover:text-stack-overflow py-2 px-2 no-underline" data-balloon="Stack Overflow" data-balloon-pos="down">
                <svg aria-hidden="true" alt="Stack Overflow" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-stack-overflow fa-w-12 fa-3x">
                    <path fill="currentColor" d="M293.7 300l-181.2-84.5 16.7-36.5 181.3 84.7-16.8 36.3zm48-76L188.2 95.7l-25.5 30.8 153.5 128.3 25.5-30.8zm39.6-31.7L262 32l-32 24 119.3 160.3 32-24zM290.7 311L95 269.7 86.8 309l195.7 41 8.2-39zm31.6 129H42.7V320h-40v160h359.5V320h-40v120zm-39.8-80h-200v39.7h200V360z" class=""></path>
                </svg>
            </a>

        </footer>

    </body>

    <!-- This is bottom secret! -->

</html>
