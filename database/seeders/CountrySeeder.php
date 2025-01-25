<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $countries =
      [
         [
           'name' => 'Afghanistan',
           'phonecode' => '93',
         ],
         [
           'name' => 'Aland Islands',
           'phonecode' => '358',
         ],
         [
           'name' => 'Albania',
           'phonecode' => '355',
         ],
         [
           'name' => 'Algeria',
           'phonecode' => '213',
         ],
         [
           'name' => 'American Samoa',
           'phonecode' => '1',
         ],
         [
           'name' => 'Andorra',
           'phonecode' => '376',
         ],
         [
           'name' => 'Angola',
           'phonecode' => '244',
         ],
         [
           'name' => 'Anguilla',
           'phonecode' => '1',
         ],
         [
           'name' => 'Antarctica',
           'phonecode' => '672',
         ],
         [
           'name' => 'Antigua and Barbuda',
           'phonecode' => '1',
         ],
         [
           'name' => 'Argentina',
           'phonecode' => '54',
         ],
         [
           'name' => 'Armenia',
           'phonecode' => '374',
         ],
         [
           'name' => 'Aruba',
           'phonecode' => '297',
         ],
         [
           'name' => 'Australia',
           'phonecode' => '61',
         ],
         [
           'name' => 'Austria',
           'phonecode' => '43',
         ],
         [
           'name' => 'Azerbaijan',
           'phonecode' => '994',
         ],
         [
           'name' => 'Bahrain',
           'phonecode' => '973',
         ],
         [
           'name' => 'Bangladesh',
           'phonecode' => '880',
         ],
         [
           'name' => 'Barbados',
           'phonecode' => '1',
         ],
         [
           'name' => 'Belarus',
           'phonecode' => '375',
         ],
         [
           'name' => 'Belgium',
           'phonecode' => '32',
         ],
         [
           'name' => 'Belize',
           'phonecode' => '501',
         ],
         [
           'name' => 'Benin',
           'phonecode' => '229',
         ],
         [
           'name' => 'Bermuda',
           'phonecode' => '1',
         ],
         [
           'name' => 'Bhutan',
           'phonecode' => '975',
         ],
         [
           'name' => 'Bolivia',
           'phonecode' => '591',
         ],
         [
           'name' => 'Bonaire, Sint Eustatius and Saba',
           'phonecode' => '599',
         ],
         [
           'name' => 'Bosnia and Herzegovina',
           'phonecode' => '387',
         ],
         [
           'name' => 'Botswana',
           'phonecode' => '267',
         ],
         [
           'name' => 'Bouvet Island',
           'phonecode' => '0055',
         ],
         [
           'name' => 'Brazil',
           'phonecode' => '55',
         ],
         [
           'name' => 'British Indian Ocean Territory',
           'phonecode' => '246',
         ],
         [
           'name' => 'Brunei',
           'phonecode' => '673',
         ],
         [
           'name' => 'Bulgaria',
           'phonecode' => '359',
         ],
         [
           'name' => 'Burkina Faso',
           'phonecode' => '226',
         ],
         [
           'name' => 'Burundi',
           'phonecode' => '257',
         ],
         [
           'name' => 'Cambodia',
           'phonecode' => '855',
         ],
         [
           'name' => 'Cameroon',
           'phonecode' => '237',
         ],
         [
           'name' => 'Canada',
           'phonecode' => '1',
         ],
         [
           'name' => 'Cape Verde',
           'phonecode' => '238',
         ],
         [
           'name' => 'Cayman Islands',
           'phonecode' => '1',
         ],
         [
           'name' => 'Central African Republic',
           'phonecode' => '236',
         ],
         [
           'name' => 'Chad',
           'phonecode' => '235',
         ],
         [
           'name' => 'Chile',
           'phonecode' => '56',
         ],
         [
           'name' => 'China',
           'phonecode' => '86',
         ],
         [
           'name' => 'Christmas Island',
           'phonecode' => '61',
         ],
         [
           'name' => 'Cocos (Keeling) Islands',
           'phonecode' => '61',
         ],
         [
           'name' => 'Colombia',
           'phonecode' => '57',
         ],
         [
           'name' => 'Comoros',
           'phonecode' => '269',
         ],
         [
           'name' => 'Congo',
           'phonecode' => '242',
         ],
         [
           'name' => 'Cook Islands',
           'phonecode' => '682',
         ],
         [
           'name' => 'Costa Rica',
           'phonecode' => '506',
         ],
         [
           'name' => 'Cote D\\"Ivoire (Ivory Coast)',
           'phonecode' => '225',
         ],
         [
           'name' => 'Croatia',
           'phonecode' => '385',
         ],
         [
           'name' => 'Cuba',
           'phonecode' => '53',
         ],
         [
           'name' => 'Curaçao',
           'phonecode' => '599',
         ],
         [
           'name' => 'Cyprus',
           'phonecode' => '357',
         ],
         [
           'name' => 'Czech Republic',
           'phonecode' => '420',
         ],
         [
           'name' => 'Democratic Republic of the Congo',
           'phonecode' => '243',
         ],
         [
           'name' => 'Denmark',
           'phonecode' => '45',
         ],
         [
           'name' => 'Djibouti',
           'phonecode' => '253',
         ],
         [
           'name' => 'Dominica',
           'phonecode' => '1',
         ],
         [
           'name' => 'Dominican Republic',
           'phonecode' => '1',
         ],
         [
           'name' => 'Ecuador',
           'phonecode' => '593',
         ],
         [
           'name' => 'Egypt',
           'phonecode' => '20',
         ],
         [
           'name' => 'El Salvador',
           'phonecode' => '503',
         ],
         [
           'name' => 'Equatorial Guinea',
           'phonecode' => '240',
         ],
         [
           'name' => 'Eritrea',
           'phonecode' => '291',
         ],
         [
           'name' => 'Estonia',
           'phonecode' => '372',
         ],
         [
           'name' => 'Eswatini',
           'phonecode' => '268',
         ],
         [
           'name' => 'Ethiopia',
           'phonecode' => '251',
         ],
         [
           'name' => 'Falkland Islands',
           'phonecode' => '500',
         ],
         [
           'name' => 'Faroe Islands',
           'phonecode' => '298',
         ],
         [
           'name' => 'Fiji Islands',
           'phonecode' => '679',
         ],
         [
           'name' => 'Finland',
           'phonecode' => '358',
         ],
         [
           'name' => 'France',
           'phonecode' => '33',
         ],
         [
           'name' => 'French Guiana',
           'phonecode' => '594',
         ],
         [
           'name' => 'French Polynesia',
           'phonecode' => '689',
         ],
         [
           'name' => 'French Southern Territories',
           'phonecode' => '262',
         ],
         [
           'name' => 'Gabon',
           'phonecode' => '241',
         ],
         [
           'name' => 'Georgia',
           'phonecode' => '995',
         ],
         [
           'name' => 'Germany',
           'phonecode' => '49',
         ],
         [
           'name' => 'Ghana',
           'phonecode' => '233',
         ],
         [
           'name' => 'Gibraltar',
           'phonecode' => '350',
         ],
         [
           'name' => 'Greece',
           'phonecode' => '30',
         ],
         [
           'name' => 'Greenland',
           'phonecode' => '299',
         ],
         [
           'name' => 'Grenada',
           'phonecode' => '1',
         ],
         [
           'name' => 'Guadeloupe',
           'phonecode' => '590',
         ],
         [
           'name' => 'Guam',
           'phonecode' => '1',
         ],
         [
           'name' => 'Guatemala',
           'phonecode' => '502',
         ],
         [
           'name' => 'Guernsey and Alderney',
           'phonecode' => '44',
         ],
         [
           'name' => 'Guinea',
           'phonecode' => '224',
         ],
         [
           'name' => 'Guinea-Bissau',
           'phonecode' => '245',
         ],
         [
           'name' => 'Guyana',
           'phonecode' => '592',
         ],
         [
           'name' => 'Haiti',
           'phonecode' => '509',
         ],
         [
           'name' => 'Heard Island and McDonald Islands',
           'phonecode' => '672',
         ],
         [
           'name' => 'Honduras',
           'phonecode' => '504',
         ],
         [
           'name' => 'Hong Kong S.A.R.',
           'phonecode' => '852',
         ],

         [
           'name' => 'Hungary',
           'phonecode' => '36',
         ],
         [
           'name' => 'Iceland',
           'phonecode' => '354',
         ],
         [
           'name' => 'India',
           'phonecode' => '91',
         ],
         [
           'name' => 'Indonesia',
           'phonecode' => '62',
         ],
         [
           'name' => 'Iran',
           'phonecode' => '98',
         ],
         [
           'name' => 'Iraq',
           'phonecode' => '964',
         ],
         [
           'name' => 'Ireland',
           'phonecode' => '353',
         ],
         [
           'name' => 'Israel',
           'phonecode' => '972',
         ],
         [
           'name' => 'Italy',
           'phonecode' => '39',
         ],
         [
           'name' => 'Jamaica',
           'phonecode' => '1',
         ],
         [
           'name' => 'Japan',
           'phonecode' => '81',
         ],
         [
           'name' => 'Jersey',
           'phonecode' => '44',
         ],
         [
           'name' => 'Jordan',
           'phonecode' => '962',
         ],
         [
           'name' => 'Kazakhstan',
           'phonecode' => '7',
         ],
         [
           'name' => 'Kenya',
           'phonecode' => '254',
         ],
        [
           'name' => 'Kiribati',
           'phonecode' => '686',
         ],
        [
           'name' => 'Kosovo',
           'phonecode' => '383',
         ],
        [
           'name' => 'Kuwait',
           'phonecode' => '965',
         ],
        [
           'name' => 'Kyrgyzstan',
           'phonecode' => '996',
         ],
        [
           'name' => 'Laos',
           'phonecode' => '856',
         ],
        [
           'name' => 'Latvia',
           'phonecode' => '371',
         ],
        [
           'name' => 'Lebanon',
           'phonecode' => '961',
         ],
        [
           'name' => 'Lesotho',
           'phonecode' => '266',
         ],
        [
           'name' => 'Liberia',
           'phonecode' => '231',
         ],
        [
           'name' => 'Libya',
           'phonecode' => '218',
         ],
       [
           'name' => 'Liechtenstein',
           'phonecode' => '423',
         ],
       [
           'name' => 'Lithuania',
           'phonecode' => '370',
         ],
       [
           'name' => 'Luxembourg',
           'phonecode' => '352',
         ],
       [
           'name' => 'Macau S.A.R.',
           'phonecode' => '853',
         ],
       [
           'name' => 'Madagascar',
           'phonecode' => '261',
         ],
         [
           'name' => 'Malawi',
           'phonecode' => '265',
         ],
         [
           'name' => 'Malaysia',
           'phonecode' => '60',
         ],
         [
           'name' => 'Maldives',
           'phonecode' => '960',
         ],
         [
           'name' => 'Mali',
           'phonecode' => '223',
         ],
         [
           'name' => 'Malta',
           'phonecode' => '356',
         ],
         [
           'name' => 'Man (Isle of)',
           'phonecode' => '44',
         ],
         [
           'name' => 'Marshall Islands',
           'phonecode' => '692',
         ],
         [
           'name' => 'Martinique',
           'phonecode' => '596',
         ],
         [
           'name' => 'Mauritania',
           'phonecode' => '222',
         ],
         [
           'name' => 'Mauritius',
           'phonecode' => '230',
         ],
         [
           'name' => 'Mayotte',
           'phonecode' => '262',
         ],
         [
           'name' => 'Mexico',
           'phonecode' => '52',
         ],
         [
           'name' => 'Micronesia',
           'phonecode' => '691',
         ],
         [
           'name' => 'Moldova',
           'phonecode' => '373',
         ],
         [
           'name' => 'Monaco',
           'phonecode' => '377',
         ],
         [
           'name' => 'Mongolia',
           'phonecode' => '976',
         ],
         [
           'name' => 'Montenegro',
           'phonecode' => '382',
         ],
         [
           'name' => 'Montserrat',
           'phonecode' => '1',
         ],
         [
           'name' => 'Morocco',
           'phonecode' => '212',
         ],
         [
           'name' => 'Mozambique',
           'phonecode' => '258',
         ],
         [
           'name' => 'Myanmar',
           'phonecode' => '95',
         ],
         [
           'name' => 'Namibia',
           'phonecode' => '264',
         ],
         [
           'name' => 'Nauru',
           'phonecode' => '674',
         ],
         [
           'name' => 'Nepal',
           'phonecode' => '977',
         ],
         [
           'name' => 'Netherlands',
           'phonecode' => '31',
         ],
         [
           'name' => 'New Caledonia',
           'phonecode' => '687',
         ],
         [
           'name' => 'New Zealand',
           'phonecode' => '64',
         ],
         [
           'name' => 'Nicaragua',
           'phonecode' => '505',
         ],
         [
           'name' => 'Niger',
           'phonecode' => '227',
         ],
         [
           'name' => 'Nigeria',
           'phonecode' => '234',
         ],
         [
           'name' => 'Niue',
           'phonecode' => '683',
         ],
         [
           'name' => 'Norfolk Island',
           'phonecode' => '672',
         ],
         [
           'name' => 'North Korea',
           'phonecode' => '850',
         ],
         [
           'name' => 'North Macedonia',
           'phonecode' => '389',
         ],
         [
           'name' => 'Northern Mariana Islands',
           'phonecode' => '1',
         ],
         [
           'name' => 'Norway',
           'phonecode' => '47',
         ],
         [
           'name' => 'Oman',
           'phonecode' => '968',
         ],
         [
           'name' => 'Pakistan',
           'phonecode' => '92',
         ],
         [
           'name' => 'Palau',
           'phonecode' => '680',
         ],
         [
           'name' => 'Palestinian Territory Occupied',
           'phonecode' => '970',
         ],
         [
           'name' => 'Panama',
           'phonecode' => '507',
         ],
         [
           'name' => 'Papua New Guinea',
           'phonecode' => '675',
         ],
         [
           'name' => 'Paraguay',
           'phonecode' => '595',
         ],
         [
           'name' => 'Peru',
           'phonecode' => '51',
         ],
         [
           'name' => 'Philippines',
           'phonecode' => '63',
         ],
         [
           'name' => 'Pitcairn Island',
           'phonecode' => '870',
         ],
         [
           'name' => 'Poland',
           'phonecode' => '48',
         ],
         [
           'name' => 'Portugal',
           'phonecode' => '351',
         ],
         [
           'name' => 'Puerto Rico',
           'phonecode' => '1',
         ],
         [
           'name' => 'Qatar',
           'phonecode' => '974',
         ],
         [
           'name' => 'Reunion',
           'phonecode' => '262',
         ],
         [
           'name' => 'Romania',
           'phonecode' => '40',
         ],
         [
           'name' => 'Russia',
           'phonecode' => '7',
         ],
         [
           'name' => 'Rwanda',
           'phonecode' => '250',
         ],
         [
           'name' => 'Saint Helena',
           'phonecode' => '290',
         ],
         [
           'name' => 'Saint Kitts and Nevis',
           'phonecode' => '1',
         ],
         [
           'name' => 'Saint Lucia',
           'phonecode' => '1',
         ],
         [
           'name' => 'Saint Pierre and Miquelon',
           'phonecode' => '508',
         ],
         [
           'name' => 'Saint Vincent and the Grenadines',
           'phonecode' => '1',
         ],
         [
           'name' => 'Saint-Barthelemy',
           'phonecode' => '590',
         ],
         [
           'name' => 'Saint-Martin (French part)',
           'phonecode' => '590',
         ],
         [
           'name' => 'Samoa',
           'phonecode' => '685',
         ],
         [
           'name' => 'San Marino',
           'phonecode' => '378',
         ],
         [
           'name' => 'Sao Tome and Principe',
           'phonecode' => '239',
         ],
         [
           'name' => 'Saudi Arabia',
           'phonecode' => '966',
         ],
         [
           'name' => 'Senegal',
           'phonecode' => '221',
         ],
         [
           'name' => 'Serbia',
           'phonecode' => '381',
         ],
         [
           'name' => 'Seychelles',
           'phonecode' => '248',
         ],
         [
           'name' => 'Sierra Leone',
           'phonecode' => '232',
         ],
         [
           'name' => 'Singapore',
           'phonecode' => '65',
         ],
         [
           'name' => 'Sint Maarten (Dutch part)',
           'phonecode' => '1721',
         ],
         [
           'name' => 'Slovakia',
           'phonecode' => '421',
         ],
         [
           'name' => 'Slovenia',
           'phonecode' => '386',
         ],
         [
           'name' => 'Solomon Islands',
           'phonecode' => '677',
         ],
         [
           'name' => 'Somalia',
           'phonecode' => '252',
         ],
         [
           'name' => 'South Africa',
           'phonecode' => '27',
         ],
         [
           'name' => 'South Georgia',
           'phonecode' => '500',
         ],
         [
           'name' => 'South Korea',
           'phonecode' => '82',
         ],
         [
           'name' => 'South Sudan',
           'phonecode' => '211',
         ],
         [
           'name' => 'Spain',
           'phonecode' => '34',
         ],
         [
           'name' => 'Sri Lanka',
           'phonecode' => '94',
         ],
         [
           'name' => 'Sudan',
           'phonecode' => '249',
         ],
         [
           'name' => 'Suriname',
           'phonecode' => '597',
         ],
         [
           'name' => 'Svalbard and Jan Mayen Islands',
           'phonecode' => '47',
         ],
         [
           'name' => 'Sweden',
           'phonecode' => '46',
         ],
         [
           'name' => 'Switzerland',
           'phonecode' => '41',
         ],
         [
           'name' => 'Syria',
           'phonecode' => '963',
         ],
         [
           'name' => 'Taiwan',
           'phonecode' => '886',
         ],
         [
           'name' => 'Tajikistan',
           'phonecode' => '992',
         ],
         [
           'name' => 'Tanzania',
           'phonecode' => '255',
         ],
         [
           'name' => 'Thailand',
           'phonecode' => '66',
         ],
         [
           'name' => 'The Bahamas',
           'phonecode' => '1',
         ],
         [
           'name' => 'The Gambia ',
           'phonecode' => '220',
         ],
         [
           'name' => 'Timor-Leste',
           'phonecode' => '670',
         ],
         [
           'name' => 'Togo',
           'phonecode' => '228',
         ],
         [
           'name' => 'Tokelau',
           'phonecode' => '690',
         ],
         [
           'name' => 'Tonga',
           'phonecode' => '676',
         ],
         [
           'name' => 'Trinidad and Tobago',
           'phonecode' => '1',
         ],
         [
           'name' => 'Tunisia',
           'phonecode' => '216',
         ],
         [
           'name' => 'Turkey',
           'phonecode' => '90',
         ],
         [
           'name' => 'Turkmenistan',
           'phonecode' => '993',
         ],
         [
           'name' => 'Turks and Caicos Islands',
           'phonecode' => '1',
         ],
          [
           'name' => 'Tuvalu',
           'phonecode' => '688',
         ],
          [
           'name' => 'Uganda',
           'phonecode' => '256',
         ],
          [
           'name' => 'Ukraine',
           'phonecode' => '380',
         ],
          [
           'name' => 'United Arab Emirates',
           'phonecode' => '971',
         ],
          [
           'name' => 'United Kingdom',
           'phonecode' => '44',
         ],
          [
           'name' => 'United States',
           'phonecode' => '1',
         ],
          [
           'name' => 'United States Minor Outlying Islands',
           'phonecode' => '1',
         ],
        [
           'name' => 'Uruguay',
           'phonecode' => '598',
         ],
        [
           'name' => 'Uzbekistan',
           'phonecode' => '998',
         ],
        [
           'name' => 'Vanuatu',
           'phonecode' => '678',
         ],
        [
           'name' => 'Vatican City State (Holy See)',
           'phonecode' => '379',
         ],
        [
           'name' => 'Venezuela',
           'phonecode' => '58',
         ],
        [
           'name' => 'Vietnam',
           'phonecode' => '84',
         ],
        [
           'name' => 'Virgin Islands (British)',
           'phonecode' => '1',
         ],
        [
           'name' => 'Virgin Islands (US)',
           'phonecode' => '1',
         ],
        [
           'name' => 'Wallis and Futuna Islands',
           'phonecode' => '681',
         ],
        [
           'name' => 'Western Sahara',
           'phonecode' => '212',
         ],
        [
           'name' => 'Yemen',
           'phonecode' => '967',
         ],
        [
           'name' => 'Zambia',
           'phonecode' => '260',
         ],
         [
           'name' => 'Zimbabwe',
           'phonecode' => '263',
         ],
      ];

      foreach ($countries as $country) {
            Country::updateOrCreate(
               ['name' => $country['name']],
               [
                  'name' => $country['name'],
                  'phonecode' => $country['phonecode']
               ]
            );
      }

    }
}
