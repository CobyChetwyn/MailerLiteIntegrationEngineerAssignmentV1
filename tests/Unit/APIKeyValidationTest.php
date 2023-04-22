<?php

namespace Tests\Unit;

use Tests\TestCase;

class APIKeyValidationTest extends TestCase
{
    /**
     * This test should return pass with a valid API Key
     *
     * @return void
     */
    public function test_valid_api_key_validation()
    {
      $response = $this->withHeaders([
        'X-Header' => 'Value',
      ])->post('/api-key', ['apiKey' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI0IiwianRpIjoiZGU2NWNjNjk1Nzc5NDg5MjBjZDE1NGE0OTdjZDliZWY1YjhhMDMxZTA2YzhmOGM1NGQ5ZjFlOGZjYjZiM2FmMDA4MGQzODkzZThmOGVjYjIiLCJpYXQiOjE2ODIwMjE0NDQuMTc0OTg0LCJuYmYiOjE2ODIwMjE0NDQuMTc0OTg1LCJleHAiOjQ4Mzc2OTUwNDQuMTcwNjE1LCJzdWIiOiI0Mzg3NzIiLCJzY29wZXMiOltdfQ.p8GpIB14K0ujkmW4b6UuzhL3WFeExikK9GEQRNoezJbrVgP6d00HGaGx_0ssi3M99JHCenqX-UYJYDN_L0mDcdIsfe37NMSSnQy-NbQjoo-iIYlSxRHpg5FXt10fsYX3fgtb3lOf5zok9cWuktERmXJo-l0jPBprQysR2a8gzbnOo9mmxThju9bYo3WuvJPc4uQNoYGRMOL0WTyfV_CzGUEwne7uJ83Vc4xaB2V32UsH957JsYjcV0KUTDF8IlFQCJs5XsitpLF-o4f-9vPnWVVwxcxrIZBLzpmcpA2d6Yf8my1a8ma7bZo8RauskVpt4gtzLj9_k6MEaDAsHRVYZ8Do1cHA_itvnQEMb63D84MksFb8dmXd_H2ulifBiYUvbMNI_c9OdT6M-GYbzjmFI7Drd0c5oJsmBxNduPNbZZzMzn6py1Qpey1JwMeDl_XJ3nL0Jczc2XINh-baxObePkc9JrCp1yBsg0JYQM3Z4FV9s5_bpXL_CK7s1WIcRwkIjv4KZwsPi5LaK1BQFPU3h-NeFp4o0k8Xx-H9ShfIQiDAa2IPXHf9DOJluWnlX2erg1svkhmrE5F-V2CSCOQTpxKxXFX2aNVPeJPXENrOEkjPBQOs7LDYveGlwkfyiIwCA7qCQS67t9ESV0AR2hWe8Q-9lBbVsr_QrBiKFpICm1k']);

      $response->assertStatus(200);
    }

  /**
   * This test should return pass with an invalid API Key
   *
   * @return void
   */
  public function test_invalid_api_key_validation()
  {
    $response = $this->withHeaders([
      'X-Header' => 'Value',
    ])->post('/api-key', ['apiKey' => 'ndknskn']);

    $response->assertStatus(422);
  }

  /**
   * This test should return pass with an invalid API Key
   *
   * @return void
   */
  public function test_api_key_route_not_accessible()
  {
    $response = $this->get('/api-key');

    $response->assertStatus(405);
  }
}
