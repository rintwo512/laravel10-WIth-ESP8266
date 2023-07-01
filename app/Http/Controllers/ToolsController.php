<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;


class ToolsController extends Controller
{
    public function cosine()
    {
        return view('tools.cosine', [
            'title' => "CosPI Kalkulator"
        ]);
    }

    public function ampertova()
    {
        return view('tools.ampertova', [
            'title' => "Konversi Amper - VA"
        ]);
    }

    public function wattToAmper()
    {
        return view('tools.wattToamper', [
            'title' => "Konversi Watt - Amper"
        ]);
    }
    public function amperTowatt()
    {
        return view('tools.amperTowatt', [
            'title' => "Konversi Amper - Watt"
        ]);
    }
    public function wattTova()
    {
        return view('tools.wattTova', [
            'title' => "Konversi Watt - VA"
        ]);
    }
    public function kalkulatorEnergi()
    {
        return view('tools.kalkulatorEnergi', [
            'title' => "Kalkulator Konsumsi Energi"
        ]);
    }
    public function ohmLaw()
    {
        return view('tools.ohmLaw', [
            'title' => "Ohm Law"
        ]);
    }
    public function voltDivider()
    {
        return view('tools.voltDivider', [
            'title' => "Volt Divider"
        ]);
    }
    public function celFah()
    {
        return view('tools.celFar', [
            'title' => "Celcius - Fahrenheit"
        ]);
    }
    public function btuTopk()
    {
        return view('tools.btuTopak', [
            'title' => "Konversi Btu - PK"
        ]);
    }
    public function wattTobtu()
    {
        return view('tools.wattTobtu', [
            'title' => "Konversi Watt - Btu/h"
        ]);
    }
    public function btuTowatt()
    {
        return view('tools.btuTowatt', [
            'title' => "Konversi Btu - Watt"
        ]);
    }
    public function wattTokwh()
    {
        return view('tools.wattTokwh', [
            'title' => "Konversi Watt - KWH"
        ]);
    }
    public function joulesTowatt()
    {
        return view('tools.joulesTowatt', [
            'title' => "Konversi Joules - Watt"
        ]);
    }
    public function scrapeLinks()
    {
        return view('tools.scrapLink', [
            'title' => "Scraping Links"
        ]);
    }

    public function getLinks(Request $request)
    {

     $url = $request->links;

    $response = Http::get($url);
    $statusCode = $response->status();


        $content = $response->body();
        $crawler = new Crawler($content);

        $links = $crawler->filter('a')->each(function (Crawler $node) {
            $href = $node->attr('href');
            $text = $node->text();

            return [
                'href' => $href,
                'text' => $text,
            ];
        });

    return view('tools.getLink', [
        'title' => 'Get Links',
        'links' => $links
    ]);
  }

  public function json()
    {
        return view('tools.convertJson', [
            'title' => "Convert Json"
        ]);
    }
  public function json2()
    {
        return view('tools.convertJson2', [
            'title' => "Convert Json 2"
        ]);
    }
  public function colorPick()
    {
        return view('tools.colorPick', [
            'title' => "Color Picker"
        ]);
    }
  public function cropImage()
    {
        return view('tools.cropImage', [
            'title' => "Cropping Image"
        ]);
    }
  public function rgbColor()
    {
        return view('tools.rgbColor', [
            'title' => "RGB Color Generator"
        ]);
    }
  public function jwt()
    {
        return view('tools.jwt', [
            'title' => "JWT Generator"
        ]);
    }

}
