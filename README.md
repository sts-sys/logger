# Logger PHP

Un sistem de logare flexibil și extensibil pentru aplicațiile PHP, care suportă multiple canale de logare, rotația și arhivarea fișierelor de log, logare structurată (JSON), gestionarea erorilor și excepțiilor, callback-uri, filtre, și politici de retenție pentru loguri.

## Caracteristici

- **Multiple Canale de Logare**: Suport pentru logarea în fișiere, baze de date, email și altele.
- **Rotația și Arhivarea Fișierelor de Log**: Asigură că fișierele de log nu devin prea mari și sunt gestionate eficient.
- **Logare Structurată (Structured Logging)**: Permite logarea în format JSON pentru analiză automată și integrare cu alte sisteme.
- **Gestionarea Erorilor și Excepțiilor**: Captură automată și logare a erorilor și excepțiilor PHP.
- **Callback-uri și Evenimente de Logare**: Extinde funcționalitatea prin adăugarea de callback-uri pentru evenimente de logare.
- **Filtre și Reguli de Logare**: Controlează ce mesaje de logare sunt înregistrate.
- **Politici de Retenție pentru Loguri**: Șterge automat logurile mai vechi decât perioada specificată.

## Instalare

1. Clonează acest depozit în proiectul tău:

    1.1 Includerea în Composer
    ```bash
    "sts\logger": "dev-master"
    ```

    1.2 Clonarea manuala a proiectului.
    ```bash
    git clone https://github.com/numele-tau/logger-php.git
    ```

2. Include fișierele necesare în aplicația ta folosind un autoloader compatibil cu PSR-4 sau include-le manual.

## Utilizare de Bază

### 1. Instanțierea Logger-ului

Pentru a începe să folosești logger-ul, trebuie să instanțiezi clasa `Logger` și să adaugi canalele de logare dorite.

#### Exemplu de Logare în Fișier cu Rotație și Arhivare

```php
<?php

require_once 'path/to/autoload.php'; // Include autoloader-ul tău aici

use sts\debug\logs\Logger;
use sts\debug\logs\channels\FileDriver;

// Instanțiază logger-ul
$logger = new Logger();

// Adaugă canalul de logare în fișier cu rotație, arhivare și logare structurată
$fileDriver = new FileDriver('app.log', 10, 1024 * 1024, true); // Cache limit de 10 mesaje, mărime maximă a fișierului de 1 MB, logare structurată (JSON)
$logger->addChannel($fileDriver);

// Loghează mesaje
$logger->info('This is an info message');
$logger->error('This is an error message');
$logger->critical('This is a critical error that needs immediate attention!');
```

### 2. Gestionarea Erorilor și Excepțiilor

Logger-ul poate gestiona automat erorile și excepțiile din aplicația ta.

```php
<?php

// Înregistrează handler-ele pentru erori și excepții
$logger->registerErrorHandlers();

// Declanșează o eroare personalizată
trigger_error("This is a custom error!", E_USER_ERROR);

// Aruncă o excepție personalizată
throw new Exception("This is a custom exception!");
```

### 3. Utilizarea Formatter-ului Personalizat


Poți configura un formatter personalizat pentru logurile tale, de exemplu, pentru a loga mesaje în format JSON.

```php
<?php

$logger->setFormatter(function ($level, $message, $context) {
    return json_encode([
        'timestamp' => date('Y-m-d H:i:s'),
        'level' => strtoupper($level),
        'message' => $message,
        'context' => $context,
    ]);
});
```

### 4. Adăugarea de Callback-uri pentru Evenimente de Logare


Callback-urile permit extinderea funcționalității logger-ului, de exemplu, pentru a trimite notificări prin email.

```php
<?php

$logger->addCallback(function ($level, $message, $context) {
    if ($level === 'critical') {
        // Trimitere notificare prin email
        mail('admin@example.com', 'Critical Log', $message);
    }
});
```

### 5. Utilizarea Filtrelor pentru Loguri


Adaugă filtre pentru a controla ce mesaje de logare sunt înregistrate.

```php
<?php

$logger->addFilter(function ($level, $message) {
    // Permite doar loguri de tip 'error' și 'critical'
    return in_array($level, ['error', 'critical']);
});
```

### 6. Setarea Politicii de Retenție


Configurează o politică de retenție pentru a șterge automat logurile mai vechi decât perioada specificată.

```php
<?php

// Setează politica de retenție la 15 zile
$logger->setRetentionPolicy(15);

// Aplică politica de retenție în directorul de loguri specificat
$logger->applyRetentionPolicy('/path/to/logs');
```

## Contribuție

Contribuțiile sunt binevenite! Te rugăm să deschizi un pull request sau să raportezi probleme în secțiunea Issues.

## Licență

Acest proiect este licențiat sub licența MIT. Vezi fișierul LICENSE pentru mai multe informații.
