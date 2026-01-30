<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        pre {
            white-space: pre-wrap;
            /* Allow code to wrap */
            word-wrap: break-word;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-900">

    <!-- Container -->
    <div class="max-w-4xl mx-auto p-6">

        <div class="bg-white p-5 rounded-lg shadow-md mb-5">
            <h3 class="text-xl text-black-500 font-extrabold mb-3">API DOCUMENTATION</h3>
            <p class="mb-4"> Disclaimer This app only displays information from public sources. All manga content
                belongs to its
                respective copyright holders. We do not store any files on our servers. To read the full story and
                support the creators, please visit the source's official website.</p>
            <div class="flex justify-end">
                <a href="https://github.com/yandev2" target="_blank"
                    class="inline-flex items-center gap-2 text-gray-700 hover:text-black transition">

                    <img src="https://github.com/yandev2.png" alt="GitHub Avatar" class="w-6 h-6 rounded-full" />

                    <span class="font-medium">Developer Info</span>
                </a>
            </div>

        </div>

        <div class="bg-white p-5 rounded-lg shadow-md mb-5">
            <h3 class="text-xl font-semibold text-black-500 mb-2">base url</h3>
            <p> <code class="bg-gray-200 p-1 rounded">https://mangasource.vercel.app/api/api</code></p>
        </div>

        <!-- Endpoint: 1 -->
        <div class="bg-white p-5 rounded-lg shadow-md mb-5">
            <div class="flex items-center justify-between space-x-4 mb-5">
                <h3 class="text-xl text-black-500 font-extrabold">MANGA QUERY DASHBOARD</h3>
                <button
                    onclick="window.open('https://mangasource.vercel.app/api/api/manga_query_dashboard/status/Ongoing', '_blank')"
                    class="bg-amber-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                    Try
                </button>
            </div>

            <p class="mb-3"> <code class="bg-gray-200 p-1 rounded"><span class="text-blue-600">base
                            url</span>/manga_query_dashboard/{key}/{value}</code>
            </p>
            @php
            $endpoint = [
            ['key' => 'type', 'ket' => 'Manga, Manhwa, Manhua'],
            ['key' => 'genre', 'ket' => 'Action, Adventure, Boys-Love, Comedy, Crime, Drama, Fantasy, Girls-Love, Harem,
            Historical, Horror, Isekai, Magical-Girls, Mecha, Medical, Music, Mystery, Philosophical, Psychological,
            Romance, Sci-Fi, Shoujo-Ai, Shounen-Ai, Slice-of-Life, Sports, Superhero, Thriller, Tragedy, Wuxia, Yuri'],
            ['key' => 'status', 'ket' => 'Ongoing, Completed'],
            ['key' => 'konten', 'ket' => 'Ecchi, Gore, Sexual Violence, Smut'],
            ['key' => 'demografis', 'ket' => 'Josei, Seinen, Shoujo, Shounen'],
            ];
            @endphp

            <div class="mt-4 mb-4">
                <p class="font-medium text-gray-800 mb-2">PARAMETER KEY:</p>
                <code class="bg-gray-200 p-1 rounded ">key : type - genre - status - konten - demografis</code>
            </div>

            <div class="mt-4">
                <p class="font-medium text-gray-800 mb-2">PARAMETER VALUE:</p>
                @foreach ($endpoint as $item)
                <ul class="list-disc pl-6 text-gray-700 mb-2">
                    <li><code class="bg-gray-200 p-1 rounded">{{ $item['key'] }}</code>: {{ $item['ket'] }}</li>
                </ul>
                @endforeach
            </div>

            <div class=" p-2 rounded-lg shadow-md mb-5 bg-red-300">
                <p class=" text-white font-normal"># note, adjust the value with the key</p>
            </div>



            <div class="bg-gray-50 p-3 mt-4 border-l-4 border-blue-500">
                <strong class="text-gray-700">Example Response:</strong>
                <pre class="bg-gray-100 p-3 rounded mt-2">
                  {
                    "success": bolean,
                    "message": "",
                    "data": [
                       {
                          "title": "string",
                          "ratting": "string",
                          "category": "string",
                          "type": "string",
                          "chapter": string,
                          "update": string,
                          "img": "string",
                          "url": "string"
                       },
                    ]
                  }
              </pre>
            </div>
        </div>

        <!-- Endpoint: 1 -->
        <div class="bg-white p-5 rounded-lg shadow-md mb-5">
            <div class="flex items-center justify-between space-x-4 mb-5">
                <h3 class="text-xl text-black-500 font-extrabold">MANGA POPULAR</h3>
                <button onclick="window.open('https://mangasource.vercel.app/api/api/manga_popular', '_blank')"
                    class="bg-amber-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                    Try
                </button>
            </div>

            <p class="mb-3"> <code class="bg-gray-200 p-1 rounded"><span class="text-blue-600">base
                            url</span>/manga_popular</code>
            </p>

            <div class="bg-gray-50 p-3 mt-4 border-l-4 border-blue-500">
                <strong class="text-gray-700">Example Response:</strong>
                <pre class="bg-gray-100 p-3 rounded mt-2">
                  {
                    "success": bolean,
                    "message": "",
                    "data": [
                       {
                          "title": "string",
                          "ratting": "string",
                          "category": "string",
                          "type": "string",
                          "chapter": string,
                          "update": string,
                          "img": "string",
                          "url": "string"
                       },
                    ]
                  }
              </pre>
            </div>
        </div>

        <!-- Endpoint: 1 -->
        <div class="bg-white p-5 rounded-lg shadow-md mb-5">
            <div class="flex items-center justify-between space-x-4 mb-5">
                <h3 class="text-xl text-black-500 font-extrabold">MANGA NEW</h3>
                <button onclick="window.open('https://mangasource.vercel.app/api/api/manga_terbaru', '_blank')"
                    class="bg-amber-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                    Try
                </button>
            </div>

            <p class="mb-3"> <code class="bg-gray-200 p-1 rounded"><span class="text-blue-600">base
                            url</span>/manga_terbaru</code>
            </p>

            <div class="bg-gray-50 p-3 mt-4 border-l-4 border-blue-500">
                <strong class="text-gray-700">Example Response:</strong>
                <pre class="bg-gray-100 p-3 rounded mt-2">
                  {
                    "success": bolean,
                    "message": "",
                    "data": [
                       {
                          "title": "string",
                          "ratting": "string",
                          "category": "string",
                          "type": "string",
                          "chapter": string,
                          "update": string,
                          "img": "string",
                          "url": "string"
                       },
                    ]
                  }
              </pre>
            </div>
        </div>

        <!-- Endpoint: 1 -->
        <div class="bg-white p-5 rounded-lg shadow-md mb-5">
            <div class="flex items-center justify-between space-x-4 mb-5">
                <h3 class="text-xl text-black-500 font-extrabold">MANGA QUERY</h3>
                <button onclick="window.open('https://mangasource.vercel.app/api/api/genre', '_blank')"
                    class="bg-amber-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                    Try
                </button>
            </div>

            <p class="mb-3"> <code class="bg-gray-200 p-1 rounded"><span class="text-blue-600">base
                            url</span>/genre</code>
            </p>
            <p class="mb-3"> <code class="bg-gray-200 p-1 rounded"><span class="text-blue-600">base
                            url</span>/type</code>
            </p>
            <p class="mb-3"> <code class="bg-gray-200 p-1 rounded"><span class="text-blue-600">base
                            url</span>/status</code>
            </p>
            <p class="mb-3"> <code class="bg-gray-200 p-1 rounded"><span class="text-blue-600">base
                            url</span>/theme</code>
            </p>
            <div class=" p-2 rounded-lg shadow-md mb-5 bg-red-300">
                <p class=" text-white font-normal"># This endpoint is to retrieve a list of queries on manga such as
                    genre, type, status and theme.</p>
            </div>


            <div class="bg-gray-50 p-3 mt-4 border-l-4 border-blue-500">
                <strong class="text-gray-700">Example Response:</strong>
                <pre class="bg-gray-100 p-3 rounded mt-2">
                  {
                    "success": bolean,
                    "message": "",
                    "data": [
                        "string",
                    ]
                  }
              </pre>
            </div>
        </div>

        <!-- Endpoint: 1 -->
        <div class="bg-white p-5 rounded-lg shadow-md mb-5">
            <div class="flex items-center justify-between space-x-4 mb-5">
                <h3 class="text-xl text-black-500 font-extrabold">MANGA SEARCH</h3>
                <button onclick="window.open('https://mangasource.vercel.app/api/api/manga_search/boruto', '_blank')"
                    class="bg-amber-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                    Try
                </button>
            </div>

            <p class="mb-3"> <code class="bg-gray-200 p-1 rounded"><span class="text-blue-600">base
                            url</span>/manga_search/{param}</code>
            </p>
            <div class=" p-2 rounded-lg shadow-md mb-5 bg-red-300">
                <p class=" text-white font-normal"># param is filled with the title of the manga you want to search for,
                    for example /manga_search/boruto</p>
            </div>

            <div class="bg-gray-50 p-3 mt-4 border-l-4 border-blue-500">
                <strong class="text-gray-700">Example Response:</strong>
                <pre class="bg-gray-100 p-3 rounded mt-2">
                  {
                    "success": bolean,
                    "message": "",
                    "data": [
                       {
                          "title": "string",
                          "ratting": "string",
                          "category": "string",
                          "type": "string",
                          "chapter": string,
                          "update": string,
                          "img": "string",
                          "url": "string"
                       },
                    ]
                  }
              </pre>
            </div>
        </div>

        <!-- Endpoint: 1 -->
        <div class="bg-white p-5 rounded-lg shadow-md mb-5">
            <div class="flex items-center justify-between space-x-4 mb-5">
                <h3 class="text-xl text-black-500 font-extrabold">MANGA WITH PAGE</h3>
                <button onclick="window.open('https://mangasource.vercel.app/api/api/manga_color_page/1', '_blank')"
                    class="bg-amber-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                    Try
                </button>
            </div>

            @php
            $endpoint = [
            '/manga_color_page/{page}',
            '/manga_black_and_white_page/{page}',
            '/manga_terbaru_page/{page}',
            '/manga_type_page/{type}/{page}',
            '/manga_genre_page/{genre}/{page}',
            '/manga_status_page/{status}/{page}',
            '/manga_theme_page/{theme}/{page}',
            '/manga_konten_page/{konten}/{page}',
            '/manga_all_page/{page}',
            ];
            @endphp

            @foreach ($endpoint as $item)
            <p class="mb-3"> <code class="bg-gray-200 p-1 rounded"><span class="text-blue-600">base
                            url</span>{{ $item }}</code>
            </p>
            @endforeach

            @php
            $param = [
            ['key' => 'page', 'ket' => 'This is a parameter for the page and must be filled in, for example "1"'],
            ['key' => 'type, genre, status, theme', 'ket' => 'This parameter is taken from the manga query string'],
            ];
            @endphp
            <div class="mt-4">
                <p class="font-medium text-gray-800 mb-2">PARAMETER:</p>
                @foreach ($param as $item)
                <ul class="list-disc pl-6 text-gray-700 mb-2">
                    <li><code class="bg-gray-200 p-1 rounded">{{ $item['key'] }}</code>: {{ $item['ket'] }}</li>
                </ul>
                @endforeach
            </div>


            <div class=" p-2 rounded-lg shadow-md mb-5 bg-red-300">
                <p class=" text-white font-normal"># Note, each parameter must be filled in and cannot be empty</p>
            </div>

            <div class="bg-gray-50 p-3 mt-4 border-l-4 border-blue-500">
                <strong class="text-gray-700">Example Response:</strong>
                <pre class="bg-gray-100 p-3 rounded mt-2">
                  {
                    "success": bolean,
                    "message": "",
                    "data": {
                        "current_page": "1",
                        "total_page": "112",
                        "data" : [
                           {
                              "title": "string",
                              "ratting": "string",
                              "category": "string",
                              "type": "string",
                              "chapter": string,
                              "update": string,
                              "img": "string",
                              "url": "string"
                           },
                        ]
                    } 
                  }
              </pre>
            </div>
        </div>


        <!-- Endpoint: detail -->
        <div class="bg-white p-5 rounded-lg shadow-md mb-5">
            <div class="flex items-center justify-between space-x-4 mb-5">
                <h3 class="text-xl text-black-500 font-extrabold">MANGA DETAIL</h3>
                <button
                    onclick="window.open('https://mangasource.vercel.app/api/api/manga_detail/divine-leveling-system/', '_blank')"
                    class="bg-amber-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                    Try
                </button>
            </div>

            <p class="mb-3"> <code class="bg-gray-200 p-1 rounded"><span class="text-blue-600">base
                            url</span>/manga_detail/{url}</code>
            </p>
            <div class="mt-4">
                <p class="font-medium text-gray-800 mb-2">PARAMETER:</p>
                <ul class="list-disc pl-6 text-gray-700 mb-2">
                    <li><code class="bg-gray-200 p-1 rounded">url</code>: This parameter is taken from the url in the
                        manga list
                    </li>
                </ul>
            </div>

            <div class=" p-2 rounded-lg shadow-md mb-5 bg-red-300">
                <p class=" text-white font-normal"># Note, each parameter must be filled in and cannot be empty</p>
            </div>

            <div class="bg-gray-50 p-3 mt-4 border-l-4 border-blue-500">
                <strong class="text-gray-700">Example Response:</strong>
                <pre class="bg-gray-100 p-3 rounded mt-2">
                  {
                    "success": bolean,
                    "message": "",
                    "data": {
                       "title": "String",
                       "img": "String",
                       "ratting": "String",
                       "short_sinopsis": "String",
                       "status": "String",
                       "judul_alternatif": "String",
                       "pengarang": "String",
                       "ilustrator": "String",
                       "grafis": "String",
                       "jenis_komik": "String",
                       "tema": [
                          "String"
                        ],
                       "informasi": [
                           {
                             "title": "String",
                             "img": "String"
                           }
                        ],
                       "official": [
                           {
                             "title": "String",
                             "img": "String"
                           }
                        ],
                       "chapter": [
                           {
                             "url": "String",
                             "chapter": "String",
                             "update": "String"
                           }, 
                        ],
                       "spoiler": [
                           "String"
                        ],
                       "similar": [
                           {
                             "url": "String",
                             "img": "String",
                             "title": "String",
                             "subtitle": "String",
                             "type": "String",
                             "jenis": "String",
                           },
                      ]
                    }
                  }
            </pre>
            </div>
        </div>

        <!-- Endpoint: detail -->
        <div class="bg-white p-5 rounded-lg shadow-md mb-5">
            <div class="flex items-center justify-between space-x-4 mb-5">
                <h3 class="text-xl text-black-500 font-extrabold">MANGA READ</h3>
                <button
                    onclick="window.open('https://mangasource.vercel.app/api/api/manga_read/divine-leveling-system-chapter-192/', '_blank')"
                    class="bg-amber-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                    Try
                </button>
            </div>

            <p class="mb-3"> <code class="bg-gray-200 p-1 rounded"><span class="text-blue-600">base
                            url</span>/manga_read/{url}</code>
            </p>
            <div class="mt-4">
                <p class="font-medium text-gray-800 mb-2">PARAMETER:</p>
                <ul class="list-disc pl-6 text-gray-700 mb-2">
                    <li><code class="bg-gray-200 p-1 rounded">url</code>: This parameter is taken from the url in the
                        manga list chapter
                    </li>
                </ul>
            </div>

            <div class=" p-2 rounded-lg shadow-md mb-5 bg-red-300">
                <p class=" text-white font-normal"># Note, each parameter must be filled in and cannot be empty</p>
            </div>

            <div class="bg-gray-50 p-3 mt-4 border-l-4 border-blue-500">
                <strong class="text-gray-700">Example Response:</strong>
                <pre class="bg-gray-100 p-3 rounded mt-2">
                  {
                    "success": bolean,
                    "message": "",
                    "data": {
                      "title": "String",
                      "img": [
                        "String"
                      ],
                      "back_chapter": "String",
                      "next_chapter": "String"
                    }
                  }
            </pre>
            </div>
        </div>


    </div>
    </div>


</body>

</html>