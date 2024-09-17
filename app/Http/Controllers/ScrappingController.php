<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class ScrappingController extends Controller
{
    private function fetchDatasetDetails(Client $client, $url)
    {
        // Mengirimkan request HTTP ke URL dataset
        $response = $client->request('GET', $url);

        // Mendapatkan konten HTML dari respons
        $html = $response->getBody()->getContents();

        // Gunakan Crawler untuk memparsing HTML
        $crawler = new Crawler($html);

        // Mengambil judul dataset
        $datasetName = $crawler->filter('h1.text-3xl.font-semibold.text-primary-content')->text();

        // Mengambil abstract dataset
        $abstract = $crawler->filter('p.svelte-1xc1tf7')->count() ? $crawler->filter('p.svelte-1xc1tf7')->text() : 'No abstract available';

        // Mengambil informasi dataset (bagian "Dataset Information")
        $datasetInformation = $crawler->filter('div.p-4.pt-0')->count() ? $crawler->filter('div.p-4.pt-0')->html() : 'Dataset Information not available';

        return [
            'dataset_name' => $datasetName,
            'abstract' => $abstract,
            'dataset_information' => $datasetInformation,
        ];
    }

    public function index()
    {
        // Inisialisasi Guzzle client
        $client = new Client();

        // URL utama yang berisi kumpulan dataset
        $mainUrl = 'https://archive.ics.uci.edu/datasets?skip=0&take=25&sort=desc&orderBy=NumHits&search=';

        // Mengirimkan request ke halaman utama untuk mendapatkan link dataset
        $mainResponse = $client->request('GET', $mainUrl);
        $mainHtml = $mainResponse->getBody()->getContents();
        $crawler = new Crawler($mainHtml);

        // Mengambil semua link ke halaman dataset individual
        $datasetLinks = $crawler->filter('a.link-hover.link.text-xl.font-semibold')->each(function (Crawler $node) {
            return $node->attr('href');
        });

        $data = [];
        foreach ($datasetLinks as $link) {
            // Buat URL lengkap untuk setiap dataset
            $fullUrl = 'https://archive.ics.uci.edu' . $link;

            // Ambil informasi dataset
            $datasetDetails = $this->fetchDatasetDetails($client, $fullUrl);

            // Menambahkan data ke array
            $data[] = $datasetDetails;
        }

        // Mengembalikan hasil dalam format JSON
        return response()->json($data);
    }
}
