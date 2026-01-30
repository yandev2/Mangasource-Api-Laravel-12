<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArrayResource;
use Illuminate\Support\Facades\Log;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

class ApiController extends Controller
{
    public $baseUrl = 'https://komikindo3.com/';
    public $errorMsg = 'oops, an error occurred while retrieving data';


    public function service_content($filter)
    {
        try {
            $data = [];
            $filter->each(function (Crawler $v) use (&$data) {
                $data[] = [
                    'title' => $v->filter('.tt')->count() > 0
                        ? $v->filter('.tt')->text()
                        : null,
                    'ratting' => $v->filter('.adds .rating')->count() > 0
                        ? $v->filter('.adds .rating')->text()
                        : null,
                    'category' => $v->filter('.warnalabel')->count() > 0
                        ? $v->filter('.warnalabel')->text()
                        : 'Hitam Putih',
                    'type' =>  $v->filter('.typeflag ')->count() > 0
                        ? $v->filter('.typeflag ')->attr('class')
                        : null,
                    'chapter' => $v->filter('.lsch')->count() > 0
                        ? $v->filter('.lsch')->children('a')->text()
                        : null,
                    'update' => $v->filter('.datech')->count() > 0
                        ? $v->filter('.datech')->text()
                        : null,
                    'img' => $v->filter('.limit')->children('img')->count() > 0
                        ? $v->filter('.limit')->children('img')->attr('src')
                        : null,
                    'url' => str_replace($this->baseUrl . 'komik/', '', $v->children('a')->attr('href')),
                ];
            });


            $data = collect($data)->map(function ($v) {
                if ($v['type'] !== null) {
                    $v['type'] = str_replace('typeflag', '', $v['type']);
                }
                return $v;
            });

            return $data;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    public function service_page($crawler, $crawler2)
    {
        $currentPage = '1';
        $totalPage   = '1';

        // =====================
        // CURRENT PAGE (AMAN)
        // =====================
        $crawler->filter('.pagination .page-numbers.current')->each(function ($node) use (&$currentPage) {
            $currentPage = trim($node->text());
        });

        // =====================
        // TOTAL PAGE (AMAN TOTAL)
        // =====================
        $pages = [];

        $crawler2->filter('.pagination .page-numbers')->each(function ($node) use (&$pages) {
            $text = trim($node->text());

            // Ambil HANYA ANGKA
            if (ctype_digit($text)) {
                $pages[] = (int) $text;
            }
        });

        if (!empty($pages)) {
            $totalPage = (string) max($pages);
        }

        return [
            'current_page' => $currentPage,
            'total_page'   => $totalPage,
        ];
    }





    public function genre()
    {
        try {
            $result = ['Action', 'Adventure', 'Boys-Love', 'Comedy', 'Crime', 'Drama', 'Fantasy', 'Girls-Love', 'Harem', 'Historical', 'Horror', 'Isekai', 'Magical-Girls', 'Mecha', 'Medical', 'Music', 'Mystery', 'Philosophical', 'Psychological', 'Romance', 'Sci-Fi', 'Shoujo-Ai', 'Shounen-Ai', 'Slice-of-Life', 'Sports', 'Superhero', 'Thriller', 'Tragedy', 'Wuxia', 'Yuri'];
            return new ArrayResource(true, '', $result);
        } catch (\Throwable $th) {
            return new ArrayResource(false, $this->errorMsg, null);
        }
    }

    public function type()
    {
        try {
            $result = ['Manga', 'Manhwa', 'Manhua'];
            return new ArrayResource(true, '', $result);
        } catch (\Throwable $th) {
            return new ArrayResource(false, $this->errorMsg, null);
        }
    }

    public function status()
    {
        try {
            $result = ['Ongoing', 'Completed'];
            return new ArrayResource(true, '', $result);
        } catch (\Throwable $th) {
            return new ArrayResource(false, $this->errorMsg, null);
        }
    }

    public function theme()
    {
        try {
            $result = ['Aliens', 'Animals', 'Cooking', 'Crossdressing', 'Delinquents', 'Demons', 'Ecchi', 'Genderswap', 'Ghosts', 'Gore', 'Gyaru', 'Harem', 'Incest', 'Loli', 'Mafia', 'Magic', 'Martial-Arts', 'Military', 'Monster-Girls', 'Monsters', 'Music', 'Ninja', 'Office-Workers', 'Police', 'Post-Apocalyptic', 'Reincarnation', 'Reverse-Harem', 'Samurai', 'School-Life', 'Shota', 'Smut', 'Supernatural', 'Survival', 'Time-Travel', 'Traditional-Games', 'Vampires', 'Video-Games', 'Villainess', 'Virtual-Reality', 'Zombies'];
            return new ArrayResource(true, '', $result);
        } catch (\Throwable $th) {
            return new ArrayResource(false, $this->errorMsg, null);
        }
    }

    public function manga_popular()
    {
        try {
            $browser = new HttpBrowser(HttpClient::create());
            $crawler = $browser->request('GET', $this->baseUrl);
            $filter = $crawler->filter('.post-show.mangapopuler .odadingslider .animposx');
            $data =   $this->service_content($filter);
            return new ArrayResource(true, '', $data);
        } catch (\Throwable $th) {
            return new ArrayResource(false, $this->errorMsg, null);
        }
    }

    public function manga_query_dashboard($key, $value)
    {
        try {
            $url = '';
            if (strtolower($key) == 'status') {
                $url = $this->baseUrl . 'daftar-manga/?status=' . $value . '&type=&format=0&order=&title=';
            } else if (strtolower($key) == 'konten') {
                $url = $this->baseUrl . 'daftar-manga/?konten%5B%5D=' . $value . '&status=&type=&format=&order=&title=';
            } else if (strtolower($key) == 'type') {
                $url = $this->baseUrl . 'daftar-manga/' . $value;
            } else if (strtolower($key) == 'genre') {
                $url = $this->baseUrl . 'daftar-manga/?genre%5B%5D=' . $value . '&status=&type=&format=&order=&title=';
            } else {
                $url = $this->baseUrl . 'daftar-manga/?demografis%5B%5D=' . $value . '&status=&type=&format=&order=&title=';
            }

            $browser = new HttpBrowser(HttpClient::create());
            $crawler = $browser->request('GET', $url);
            $filter = $crawler->filter('.listupd .animposx');
            $data = $this->service_content($filter)->take(7);
            return new ArrayResource(true, '', $data);
        } catch (\Throwable $th) {
            return new ArrayResource(false, $this->errorMsg, null);
        }
    }

    public function manga_terbaru()
    {
        try {
            $url =  $this->baseUrl . 'komik-terbaru/';
            $browser = new HttpBrowser(HttpClient::create());
            $crawler = $browser->request('GET', $url);
            $filter = $crawler->filter('.listupd .animposx');
            $data = $this->service_content($filter)->take(7);
            return new ArrayResource(true, '', $data);
        } catch (\Throwable $th) {
            return new ArrayResource(false, $this->errorMsg, null);
        }
    }

    public function manga_search($query)
    {
        try {
            $url =  $this->baseUrl . '?s=' . strtolower($query);
            $browser = new HttpBrowser(HttpClient::create());
            $crawler = $browser->request('GET', $url);
            $filter = $crawler->filter('.film-list .animposx');
            $data = $this->service_content($filter);

            return new ArrayResource(true, '', $data);
        } catch (\Throwable $th) {
            return new ArrayResource(false, $this->errorMsg, null);
        }
    }


    // api with page
    public function manga_color_page($page)
    {
        try {
            $url = $page == '1'
                ? $this->baseUrl . 'komik-berwarna/'
                : $this->baseUrl . 'komik-berwarna/page/' . $page;
            $browser = new HttpBrowser(HttpClient::create());
            $crawler = $browser->request('GET', $url);
            $crawler2 = $browser->request('GET', $this->baseUrl . 'komik-berwarna/');
            $filter = $crawler->filter('.widget-body .listupd .animposx');
            $data = $this->service_content($filter);
            $pagination =  $this->service_page($crawler, $crawler2);
            $response = [
                'current_page' => $pagination['current_page'],
                'total_page' => $pagination['total_page'],
                'data' =>  $data
            ];

            return new ArrayResource(true, '', $response);
        } catch (\Throwable $th) {
            return new ArrayResource(false, $this->errorMsg, null);
        }
    }

    public function manga_black_and_white_page($page)
    {
        try {
            $url = $page == '1'
                ? $this->baseUrl . 'daftar-manga/?status=&type=&format=bw&order=&title='
                : $this->baseUrl . 'daftar-manga/page/' . $page . '/?status&type&format=bw&order&title';
            $browser = new HttpBrowser(HttpClient::create());
            $crawler = $browser->request('GET', $url);
            $crawler2 = $browser->request('GET', $this->baseUrl . 'daftar-manga/?status=&type=&format=bw&order=&title=');
            $filter = $crawler->filter('.listupd .animposx');
            $data = $this->service_content($filter);
            $pagination =  $this->service_page($crawler, $crawler2);
            $response = [
                'current_page' => $pagination['current_page'],
                'total_page' => $pagination['total_page'],
                'data' =>  $data
            ];

            return new ArrayResource(true, '', $response);
        } catch (\Throwable $th) {
            return new ArrayResource(false, $this->errorMsg, null);
        }
    }

    public function manga_terbaru_page($page)
    {
        try {
            $url = $page == '1'
                ? $this->baseUrl . 'komik-terbaru/'
                : $this->baseUrl . 'komik-terbaru/page/' . $page;
            $browser = new HttpBrowser(HttpClient::create());
            $crawler = $browser->request('GET', $url);
            $crawler2 = $browser->request('GET', $this->baseUrl . 'komik-terbaru/');
            $filter = $crawler->filter('.widget-body .listupd .animposx');
            $data = $this->service_content($filter);
            $pagination =  $this->service_page($crawler, $crawler2);
            $response = [
                'current_page' => $pagination['current_page'],
                'total_page' => $pagination['total_page'],
                'data' =>  $data
            ];
            return new ArrayResource(true, '', $response);
        } catch (\Throwable $th) {
            return new ArrayResource(false, $this->errorMsg, null);
        }
    }

    public function manga_type_page($type, $page)
    {
        try {
            $url = $page == '1'
                ? $this->baseUrl . 'daftar-manga/?status=&type=' . $type . '&format=&order=&title='
                : $this->baseUrl . 'daftar-manga/page/' . $page . '/?status&type=' . $type . '&format&order&title';
            $browser = new HttpBrowser(HttpClient::create());
            $crawler = $browser->request('GET', $url);
            $crawler2 = $browser->request('GET',  $this->baseUrl . 'daftar-manga/?status=&type=' . $type . '&format=&order=&title=');
            $filter = $crawler->filter('.listupd .animposx');
            $data = $this->service_content($filter);
            $pagination =  $this->service_page($crawler, $crawler2);
            $response = [
                'current_page' => $pagination['current_page'],
                'total_page' => $pagination['total_page'],
                'data' =>  $data
            ];

            return new ArrayResource(true, '', $response);
        } catch (\Throwable $th) {
            return new ArrayResource(false, $this->errorMsg, null);
        }
    }

    public function manga_genre_page($genre, $page)
    {
        try {
            $url = $page == '1'
                ? $this->baseUrl . 'daftar-manga/?genre%5B%5D=' . $genre . '&status=&type=&format=0&order=&title='
                : $this->baseUrl . 'daftar-manga/page/' . $page . '/?genre%5B0%5D=' . $genre . '&status&type&format=0&order&title';

            $browser = new HttpBrowser(HttpClient::create());
            $crawler = $browser->request('GET', $url);
            $crawler2 = $browser->request('GET',  $this->baseUrl . 'daftar-manga/?genre%5B%5D=' . $genre . '&status=&type=&format=0&order=&title=');

            $filter = $crawler->filter('.listupd .animposx');
            $data = $this->service_content($filter);
            $pagination =  $this->service_page($crawler, $crawler2);
            $response = [
                'current_page' => $pagination['current_page'],
                'total_page' => $pagination['total_page'],
                'data' => $data
            ];

            return new ArrayResource(true, '', $response);
        } catch (\Throwable $th) {
            return new ArrayResource(false, $th->getMessage(), null);
        }
    }

    public function manga_status_page($status, $page)
    {
        try {
            $url = $page == '1'
                ? $this->baseUrl . 'daftar-manga/?status=' . $status . '&type=&format=&order=&title='
                : $this->baseUrl . 'daftar-manga/page/' . $page . '/?status=' . $status . '&type&format&order&title';
            $browser = new HttpBrowser(HttpClient::create());
            $crawler = $browser->request('GET', $url);
            $crawler2 = $browser->request('GET',  $this->baseUrl . 'daftar-manga/?status=' . $status . '&type=&format=&order=&title=');
            $filter = $crawler->filter('.listupd .animposx');
            $data = $this->service_content($filter);
            $pagination =  $this->service_page($crawler, $crawler2);
            $response = [
                'current_page' => $pagination['current_page'],
                'total_page' => $pagination['total_page'],
                'data' =>  $data
            ];

            return new ArrayResource(true, '', $response);
        } catch (\Throwable $th) {
            return new ArrayResource(false, $this->errorMsg, null);
        }
    }

    public function manga_theme_page($theme, $page)
    {
        try {
            $url = $page == '1'
                ? $this->baseUrl . 'daftar-manga/?tema%5B%5D=' . $theme . '&status=&type=&format=&order=&title='
                : $this->baseUrl . 'daftar-manga/page/' . $page . '/?tema%5B0%5D=' . $theme . '&status&type&format&order&title';
            $browser = new HttpBrowser(HttpClient::create());
            $crawler = $browser->request('GET', $url);
            $crawler2 = $browser->request('GET',  $this->baseUrl . 'daftar-manga/?tema%5B%5D=' . $theme . '&status=&type=&format=&order=&title=');
            $filter = $crawler->filter('.listupd .animposx');
            $data = $this->service_content($filter);
            $pagination =  $this->service_page($crawler, $crawler2);
            $response = [
                'current_page' => $pagination['current_page'],
                'total_page' => $pagination['total_page'],
                'data' =>  $data
            ];

            return new ArrayResource(true, '', $response);
        } catch (\Throwable $th) {
            return new ArrayResource(false, $this->errorMsg, null);
        }
    }
    public function manga_all_page($page)
    {
        try {
            $url = $page == '1'
                ? $this->baseUrl . 'daftar-manga/?status=&type=&format=&order=&title='
                : $this->baseUrl . 'daftar-manga/page/' . $page . '?status&type&format&order&title';
            $browser = new HttpBrowser(HttpClient::create());
            $crawler = $browser->request('GET', $url);
            $crawler2 = $browser->request('GET',  $this->baseUrl . 'daftar-manga/?status=&type=&format=&order=&title=');
            $filter = $crawler->filter('.listupd .animposx');
            $data = $this->service_content($filter);
            $pagination =  $this->service_page($crawler, $crawler2);
            $response = [
                'current_page' => $pagination['current_page'],
                'total_page' => $pagination['total_page'],
                'data' =>  $data
            ];

            return new ArrayResource(true, '', $response);
        } catch (\Throwable $th) {
            return new ArrayResource(false, $this->errorMsg, null);
        }
    }

    public function manga_detail($url)
    {
        try {

            $urls = $this->baseUrl . 'komik/' . $url;
            $browser = new HttpBrowser(HttpClient::create());
            $crawler = $browser->request('GET', $urls);
            $filter = $crawler->filter('.postbody');
            $data = [];

            $data['title'] =  $filter->filter('.entry-title')->text();
            $data['img'] = $filter->filter('.thumb')->children('img')->attr('src');
            $data['ratting'] =  $filter->filter('.thumb .rt .clearfix.archiveanime-rating')->children('i')->text();
            $data['short_sinopsis'] = $filter->filter('.shortcsc.sht2')->count() > 0
                ? $filter->filter('.shortcsc.sht2')->text()
                : null;
            $data['sinopsis'] = trim(str_replace(['\\', '"'], ['', ''], $filter->filter('.tabsarea #sinopsis')->text() ?? 'null'));
            $data['spoiler'] = $filter->filter('.tabsarea .spoiler  .spoiler-img')->count() == 0 ? [] :  $filter->filter('.tabsarea .spoiler  .spoiler-img')->each(function ($v) {
                $b = str_replace(['this.onerror=null;this.src=', ';', "'"], '', $v->children('img')->attr('onerror'));
                return $b;
            });
            $data['similar'] = $filter->filter('#mirip .serieslist')->children('ul')->children('li')->count() == 0 ? [] : $filter->filter('#mirip .serieslist')->children('ul')->children('li')->each(function ($v) {
                $jenis = $v->filter('.extras')->each(function ($v) {
                    return trim(str_replace($v->filter('b')->text(), '', $v->text()));
                });
                return  [
                    'url' => str_replace($this->baseUrl . 'komik/', '', $v->filter('.imgseries')->children('a')->attr('href')),
                    'img' => $v->filter('.imgseries')->children('a')->children('img')->attr('src'),
                    'title' => $v->filter('.leftseries .series')->text(),
                    'subtitle' => $v->filter('.excerptmirip')->text(),
                    'type' => $v->filter('.imgseries .series .typeflag ')->attr('class'),
                    'jenis' => implode(' ', $jenis),
                ];
            });


            $info = ['Status:', 'Judul Alternatif:', 'Pengarang:', 'Ilustrator:', 'Grafis:', 'Jenis Komik:', 'Tema:', 'Informasi:', 'Official:'];

            for ($i = 0; $i < count($info); $i++) {
                $replace = ['_', ''];
                $with = [' ', ':'];
                $key = strtolower(str_replace($with, $replace, $info[$i]));
                $querys = $filter->filter('.infox .spe')->filter('span:contains("' . $info[$i] . '")');

                if (in_array($info[$i], ['Informasi:', 'Official:'])) {
                    if ($querys->count() > 0) {
                        $query = $querys->filter('.person');
                        $value =  $query->each(function (Crawler $node) {
                            if ($node->text() !== '') {
                                return [
                                    'title' => $node->text(),
                                    'img' => $node->filter('.img')->children('a img')->attr('src')
                                ];
                            }
                        });
                        $remove_null_data = array_filter($value, function ($item) {
                            return !is_null($item);
                        });
                        $data[$key] = $remove_null_data;
                    } else {
                        $data[$key] = [];
                    }
                } else if ($info[$i] === 'Tema:') {
                    if ($querys->count() > 0) {
                        $query = $querys->children('a')->each(fn(Crawler $v) => $v->text());
                        $data[$key] = $query;
                    } else {
                        $data[$key] = [];
                    }
                } else {
                    if ($querys->count() > 0) {
                        $query = $querys->text();
                        $replace_key = str_replace([$info[$i], ' '], ['', ''], $query);
                        $data[$key] = $replace_key;
                    } else {
                        $data[$key] = null;
                    }
                }
            }
            $data['genre'] =  $filter->filter('.infox .genre-info ')->children('a')->count() == 0 ? [] : $filter->filter('.infox .genre-info ')->children('a')->each(fn($v) => $v->text());

            $data['chapter'] = $filter->filter('.eps_lst #chapter_list')->children('ul')->children('li')->count() == 0 ? [] : $filter->filter('.eps_lst #chapter_list')->children('ul')->children('li')->each(function ($v) {
                return  [
                    'url' => str_replace($this->baseUrl, '', $v->filter('.lchx')->children('a')->attr('href')),
                    'chapter' => $v->filter('.lchx')->text(),
                    'update' => $v->filter('.dt')->text()
                ];
            });
            return new ArrayResource(true, '', $data);
        } catch (\Throwable $th) {
            return new ArrayResource(false, $this->errorMsg, null);
        }
    }

    public function manga_read($url)
    {
        try {
            $browser = new HttpBrowser(HttpClient::create());
            $crawler = $browser->request('GET', $this->baseUrl . $url);
            $filter = $crawler->filter('#content');

            $data = [];
            $data['title'] = $filter->filter('.chapter-content .dtlx .entry-title')->text();
            $data['img'] = $filter->filter('.chapter-content #chimg-auh')->children('img')->each(function ($v) {
                return $v->attr('src');
            });

            $data['back_chapter'] = $filter->filter('.chapter-content .navig .nextprev')->children('a[rel="prev"]')->each(function ($v) {
                return $v->attr('href');
            });
            $data['back_chapter'] = array_filter($data['back_chapter'], fn($item) => !is_null($item));
            $data['back_chapter'] = str_replace($this->baseUrl, '',  array_shift($data['back_chapter']));

            $data['next_chapter'] = $filter->filter('.chapter-content .navig .nextprev')->children('a[rel="next"]')->each(function ($v) {
                return $v->attr('href');
            });
            $data['next_chapter'] = array_filter($data['next_chapter'], fn($item) => !is_null($item));

            $data['next_chapter'] = str_replace($this->baseUrl, '', array_shift($data['next_chapter']));
            return new ArrayResource(true, '', $data);
        } catch (\Throwable $th) {
            return new ArrayResource(false, $this->errorMsg, null);
        }
    }
}
