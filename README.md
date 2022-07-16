## Kalimati Fruits and Vegetable Market Development Board (Current: Laravel 8.*) ([Live](https://kalimatimarket.gov.np))

<br/>
[![StyleCI](https://github.styleci.io/repos/326489547/shield?style=plastic)](https://github.styleci.io/repos/30171828)
![Tests](https://github.com/coderkoala/kalimati/workflows/Tests/badge.svg?branch=master)
<br/>
![GitHub contributors](https://img.shields.io/github/contributors/coderkoala/kalimati.svg)
![GitHub stars](https://img.shields.io/github/stars/coderkoala/kalimati.svg?style=social)

### Demo Credentials

**Admin:** admin@admin.com  
**Password:** secret

### Introduction

Kalimati Fruits and Vegetables Markets is the pioneer organized terminal wholesale market in Nepal where retailers, institutional consumers and other bulk consumers procure their supplies. This market alone covers 60 to 70 percent of demand of Kathmandu valley. For giving an organized shape to the marketing of agricultural produce, especially, vegetables and fruits in Kathmandu valley, Kalimati Fruits and Vegetables Wholesale Market was set up by then the Department of Food and Agriculture Marketing Services under the Ministry of Agriculture in 1986.

This repositary provides you with a complete overlook on the website's operations. Out of the box it has features like a backend built on CoreUI with Spatie/Permission authorization. It has a frontend scaffold built on Bootstrap 4. Other features such as Two Factor Authentication, User/Role management, searchable/sortable tables built on rappasoft's[Laravel Livewire tables plugin](https://github.com/rappasoft/laravel-livewire-tables), user impersonation, timezone support, multi-lingual support with 20+ built in languages, demo mode, and much more.

### Run Locally

Clone the project

```bash
  git clone https://github.com/coderkoala/kalimati my-project
```

Go to the project directory

```bash
  cd my-project
```

Install dependencies

```bash
  composer install && npm install
```

Compile Assets

```bash
  npm run production
```

`Please note: Some production-sensitive database migrations, seeders and controller/view logic was redacted by my private repo's fast-forward tool for public release. Thanks for understanding.`

### Update Log
```
3df858 Fixed time interval to be 122:00
75cba6 fix: CRON
84729a Tweaks to schema for unique constraint
3dd9b9 Duplication issue
cb8a3e Merge branch 'master' of github.com:coderkoala/kalimati-private
f7e89c TraderDues Fix
748e6b Fixed commodity issue
eba80e Fixed order for import
6fb425 Added dues:clear command
1ef083 i18n init
93b39f i18n json
55c1d3 Daily Arrivals
0e251b Finished with new arrival features
17b959 Added new model for arrivals data
0e27fa @rdsramesh 7/13 translations
ecd24d Fixed orderBy on notices
3e15cb Date consolidated
582f87 modal-e-large removed
252dbe Merge branch 'master' of github.com:coderkoala/kalimati-private
ae7f38 Fixed sizes, compressed
435f0b Fixed 500/400 pages
e1933a Fixed decals
f31e50 Tweaks before final demo
afb9fb Localization on alert
316635 Fixed some wordings
f2b609 Changed copy for call for action - download
71ba90 Fixed confirmButtonText for Swal prompt
dd14c7 Fixed localization on trader dues
4406e5 Followup: 9a2f63508e5f96e7f74c01f739438adcd6904974
9a2f63 Overhauled datatables completely
623950 Fixed precision issues
b96a83 Fixed min max price
6140d5 Fix - datetime has now a localization function
c3b988 Fixed comparative prices
296d1f Fixed prices history as requested by board
c52c12 @Jillerkore : Localization changes + updated translations
3747de Localization changes to ensure dynamicity @Jillerkore
0c623e Localization
3c04da Mobile menu fix
2af387 Changed created_at to published_at
ca332a Fixed notices
717b18 Fixed asset
7cad5d Added footer settings
0c3a50 Modal blade
617726 Modal information finished
00fa53 Fixed nonexistent field
370dff Added marquee settings in backend nav-dropdown @Jillerkore
0881ca @Jillerkore Updated Kalimati app
8e93fa @Jillerkore Updated translations
e38ada Modal view
d5c17f New Fields Utilized
58104d Modal Notice feature
0e1847 Added api endpoints
0a2f54 Fix translations
4fc1c9 About us added to API
a5f1bd @Jillerkore Updated translations and polished apk
60c6ff @Jillerkore Updated app
f22e79 Added lang fields
02f312 Fixed bug in update
94c380 Fixed Blog View
1738ec Added menu management
e15fc5 substr -> mgstring_
4ed95d Fixed card content
8d882f Merge branch 'master' of github.com:coderkoala/kalimati-private
443eec Fixed content excerpt
8f763f Updated translations and added apk file @Jillerkore
7f0a27 Merge branch 'master' of github.com:coderkoala/kalimati-private
b51ace Finished up
761a18 Finalized for demo
f5c0a7 @Jillerkore updated translations for the last time
785eba Updated translations @Jillerkore
cdb5d4 @Jillerkore Updated translations.
38ebf9 Fixed a few UI elements
e5c2ca Added a bunch of features, needs translation
0859e3 Sample API for Motey
528886 Adding translation effects
b5fd5f Issue with average floating point precision
9ae3a3 Fixed priced upload
93e1e5 Added translations
bf5156 All API services booted
3177f1 New translations
8a1713 Dashboard finalized
dac015 Removed mention of
e6de19 Fixed nullable date
e4cb8d Removed explicit db usage
0f075c Nullable value taken out
a155a9 New style + new settings + a bunch of new things needing trans()
620364 Marquee
4a3401 Merge branch 'master' of github.com:coderkoala/kalimati-private
2f1160 @Jillerkore updated translations.
c653db Verb
27091f @Jillerkore updated translations.
7eb24f Fixed links
6d3733 Payment tweak
92af93 Updated notice translations @Jillerkore
f330a2 Fix - dues clear
ecb604 Merge branch 'master' of github.com:coderkoala/kalimati-private
2e33a2 finalized for demo
5d797b Notices frontend tabulation finished, modal
f6f17b Added notice module
0254d8 @Jillerkore Updated translations.
0e9d6c Added all localization menu settings
631a5e Urgent translation for file manager
1ab0eb Added default values
42a281 @Jillerkore updated translations.
b36bd9 Merge branch 'master' of github.com:coderkoala/kalimati-private
3127c5 Added all menu systems for currently accessible features
2551c2 Feature : Backend portal completed
43bba2 Updated translations
99149e Completed frontend tweaks for now
063b78 Added new translation scripts for the demo
681fa8 Theming
d221d0 Fix - AM-PM translations
59fa19 CLRF -> LF
cce20d @Jillerkore : Fixed bug, added new translations
f87b23 scoreSearch tweaked for TraderDuesPayment
7fe6d0 View completed
74893b Added transaction details
afed3d Fixed a few translation files
cb04c6 Added dashboard info for logged IP and last logged in time
891222 Tweaked some more localization functions
cdda02 Added numeric helper for numbers' i18n
905246 TraderDuesPayment Model done
f36494 Added a separate dump for stored procedures
49ed71 Fixed schema
ced7c3 Added new schemas
d6cf6c Fixed column width issues
96f97b Added new changes to db
b3eb92 Translation stub generated
9b171e Updated Nepali translations.
70d1e5 Added feat TradersDueAPI
07afb5 Removed forbiddenMessage which is now obsolete
0e4a26 Fixed a wrong translation stub
dfd0af Removed redundance translation function calls
da848a Master Controller localization refined.
821e18 Localization refined
721f4d entry done
8b6f8d Added trader dues, tweaked daily price static function
ada04f Translation module has been put behind auth-admin gate
1e4acd Init translations
088186 Daily price log completed
3a1533 WIP : CRUD for create priceLog
5290de PHPOffice installed, bunch of updates on CRUD
fde0ef Localization
6f4814 DB - fixed issues
5b7ab1 Added an SQL dump
918761 Fork 4/23 -: Initial Commit
```

### Contributing

Thank you for considering contributing to the Kalimati MIS & Website project! Please feel free to make any pull requests, or e-mail me a feature request you would like to see in the future to Nobel Dahal at iamtribulation@outlook.com.

### Security Vulnerabilities

If you discover a security vulnerability within this boilerplate, please send an e-mail to Nobel Dahal at iamtribulation@outlook.com, or create a pull request if possible. All security vulnerabilities will be promptly addressed.

### License

Copyright Ⓒ 2021 [Nobel Dahal](https://github.com/coderkoala)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
