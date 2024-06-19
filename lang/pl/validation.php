<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Pole :attribute musi zostać zaakceptowane.',
    'accepted_if' => 'Pole :attribute musi być zaakceptowane, gdy :other to :value.',
    'active_url' => 'Pole :attribute musi być prawidłowym adresem URL.',
    'after' => 'Pole :attribute musi zawierać datę następującą po :date.',
    'after_or_equal' => 'Pole :attribute musi być datą późniejszą lub równą :date.',
    'alpha' => 'Pole :attribute może zawierać tylko litery.',
    'alpha_dash' => 'Pole :attribute może zawierać tylko litery, cyfry, myślniki i podkreślenia.',
    'alpha_num' => 'Pole :attribute może zawierać tylko litery i cyfry.',
    'array' => 'Pole :attribute musi być tablicą.',
    'ascii' => 'Pole :attribute może zawierać wyłącznie jednobajtowe znaki alfanumeryczne i symbole.',
    'before' => 'Pole :attribute musi zawierać datę wcześniejszą niż :date.',
    'before_or_equal' => 'Pole :attribute musi zawierać datę wcześniejszą lub równą :date.',
    'between' => [
        'array' => 'Pole :attribute musi zawierać elementy od :min do :max.',
        'file' => 'Pole :attribute musi zawierać się w przedziale od :min do :max kilobajtów.',
        'numeric' => 'Pole :attribute musi zawierać się w przedziale od :min do :max.',
        'string' => 'TPole :attribute musi zawierać znaki od :min do :max.',
    ],
    'boolean' => 'Pole :attribute musi mieć wartość prawda lub fałsz.',
    'confirmed' => 'Potwierdzenie pola :attribute nie pasuje.',
    'current_password' => 'Hasło jest błędne.',
    'date' => 'Pole :attribute musi zawierać prawidłową datę.',
    'date_equals' => 'Pole :attribute musi zawierać datę równą :date.',
    'date_format' => 'Pole :attribute musi odpowiadać formatowi :format.',
    'decimal' => 'Pole :attribute musi zawierać miejsca dziesiętne :decimal.',
    'declined' => 'Pole :attribute musi zostać odrzucone.',
    'declined_if' => 'Pole :attribute musi zostać odrzucone, gdy :other ma wartość :value.',
    'different' => 'Pole :attribute i :other muszą być różne.',
    'digits' => 'Pole :attribute musi zawierać :digits cyfry.',
    'digits_between' => 'Pole :attribute musi zawierać cyfry od :min do :max.',
    'dimensions' => 'Pole :attribute ma nieprawidłowe wymiary obrazu.',
    'distinct' => 'Pole :attribute ma zduplikowaną wartość.',
    'doesnt_end_with' => 'Pole :attribute nie może kończyć się jednym z następujących znaków: :values.',
    'doesnt_start_with' => 'Pole :attribute nie może zaczynać się od jednego z następujących znaków: :values.',
    'email' => 'Pole :attribute musi zawierać prawidłowy adres e-mail.',
    'ends_with' => 'Pole :attribute musi kończyć się jednym z następujących: :values.',
    'enum' => 'Wybrany atrybut :attribute jest nieprawidłowy',
    'exists' => 'Wybrany atrybut :attribute jest nieprawidłowy.',
    'file' => 'Pole :attribute musi być plikiem.',
    'filled' => 'Pole :attribute musi mieć wartość.',
    'gt' => [
        'array' => 'Pole :attribute musi zawierać więcej elementów niż :value.',
        'file' => 'Pole :attribute musi być większe niż :value kilobajtów.',
        'numeric' => 'Pole :attribute musi być większe niż :value.',
        'string' => 'Pole :attribute musi być większe niż :value znaków.',
    ],
    'gte' => [
        'array' => 'Pole :attribute musi zawierać elementy :value lub więcej.',
        'file' => 'Pole :attribute musi być większe lub równe :value kilobajtów.',
        'numeric' => 'Pole :attribute musi być większe lub równe :value.',
        'string' => 'Pole :attribute musi być większe lub równe :value znaków.',
    ],
    'image' => 'Pole :attribute musi być obrazem.',
    'in' => 'Wybrany atrybut :attribute jest nieprawidłowy.',
    'in_array' => 'Pole :attribute musi istnieć w :other.',
    'integer' => 'Pole :attribute musi być liczbą całkowitą.',
    'ip' => 'Pole :attribute musi zawierać prawidłowy adres IP.',
    'ipv4' => 'Pole :attribute musi zawierać prawidłowy adres IPv4.',
    'ipv6' => 'Pole :attribute musi zawierać prawidłowy adres IPv6.',
    'json' => 'Pole :attribute musi być prawidłowym ciągiem JSON.',
    'lowercase' => 'Pole :attribute musi być pisane małymi literami.',
    'lt' => [
        'array' => 'Pole :attribute musi zawierać mniej niż :value pozycji.',
        'file' => 'Wartość pola :attribute musi być mniejsza niż :value kilobajtów.',
        'numeric' => 'Pole :attribute musi być mniejsze niż :value.',
        'string' => 'Pole :attribute musi mieć mniej niż :value znaków.',
    ],
    'lte' => [
        'array' => 'Pole :attribute nie może zawierać więcej elementów niż :value.',
        'file' => 'Pole :attribute musi być mniejsze lub równe :value kilobajtów.',
        'numeric' => 'Pole :attribute musi być mniejsze lub równe :value.',
        'string' => 'Pole :attribute musi być mniejsze lub równe :value znaków.',
    ],
    'mac_address' => 'Pole :attribute musi zawierać prawidłowy adres MAC.',
    'max' => [
        'array' => 'Pole :attribute nie może zawierać więcej niż :max elementów.',
        'file' => 'Pole :attribute nie może być większe niż :max kilobajtów.',
        'numeric' => 'Pole :attribute nie może być większe niż :max.',
        'string' => 'Pole :attribute nie może być większe niż :max znaków.',
    ],
    'max_digits' => 'Pole :attribute nie może zawierać więcej niż :max cyfr.',
    'mimes' => 'Pole :attribute musi być plikiem typu: :values.',
    'mimetypes' => 'Pole :attribute musi być plikiem typu: :values.',
    'min' => [
        'array' => 'Pole :attribute musi zawierać co najmniej :min pozycji.',
        'file' => 'Pole :attribute musi mieć co najmniej :min kilobajtów.',
        'numeric' => 'Pole :attribute musi mieć co najmniej :min.',
        'string' => 'Pole :attribute musi mieć co najmniej :min znaków.',
    ],
    'min_digits' => 'Pole :attribute musi zawierać co najmniej :min cyfr.',
    'missing' => 'Musi brakować pola :attribute.',
    'missing_if' => 'Pole :attribute musi być niedostępne, gdy :other to :value.',
    'missing_unless' => 'Pole :attribute musi być brakujące, chyba że :other to :value.',
    'missing_with' => 'Jeśli obecne jest :values, musi brakować pola :attribute.',
    'missing_with_all' => 'Pole :attribute musi być niedostępne, gdy obecne są wartości :values.',
    'multiple_of' => 'Pole :attribute musi być wielokrotnością :value.',
    'not_in' => 'Wybrany atrybut :attribute jest nieprawidłowy.',
    'not_regex' => 'Format pola :attribute jest nieprawidłowy.',
    'numeric' => 'Pole :attribute musi być liczbą.',
    'password' => [
        'letters' => 'Pole :attribute musi zawierać co najmniej jedną literę.',
        'mixed' => 'Pole :attribute musi zawierać co najmniej jedną wielką i jedną małą literę.',
        'numbers' => 'Pole :attribute musi zawierać co najmniej jedną liczbę.',
        'symbols' => 'Pole :attribute musi zawierać co najmniej jeden symbol.',
        'uncompromised' => 'Podany :attribute pojawił się w wycieku danych. Wybierz inny :attribute.',
    ],
    'present' => 'Pole :attribute musi być obecne.',
    'prohibited' => 'Pole :attribute jest zabronione.',
    'prohibited_if' => 'Pole :attribute jest zabronione, gdy :other to :value.',
    'prohibited_unless' => 'Pole :attribute jest zabronione, chyba że :other znajduje się w :values.',
    'prohibits' => 'Pole :attribute zabrania obecności :other.',
    'regex' => 'Format pola :attribute jest nieprawidłowy.',
    'required' => 'Pole :attribute jest wymagane.',
    'required_array_keys' => 'Pole :attribute musi zawierać wpisy dla: :values.',
    'required_if' => 'Pole :attribute jest wymagane, gdy :other to :value.',
    'required_if_accepted' => 'Pole :attribute jest wymagane, gdy akceptowane jest :other.',
    'required_unless' => 'Pole :attribute jest wymagane, chyba że :other występuje w :values.',
    'required_with' => 'Pole :attribute jest wymagane, gdy występuje :values.',
    'required_with_all' => 'Pole :attribute jest wymagane, gdy obecne są wartości :wartości.',
    'required_without' => 'Pole :attribute jest wymagane, gdy nie ma wartości :values.',
    'required_without_all' => 'Pole :attribute jest wymagane, gdy nie podano żadnej z wartości :values.',
    'same' => 'Pole :attribute musi pasować do :other.',
    'size' => [
        'array' => 'Pole :attribute musi zawierać elementy :size.',
        'file' => 'Pole :attribute musi mieć wartość :size kilobajty.',
        'numeric' => 'Pole :attribute musi mieć wartość :size.',
        'string' => 'Pole :attribute musi składać się ze znaków :size.',
    ],
    'starts_with' => 'Pole :attribute musi zaczynać się od jednego z następujących: :values.',
    'string' => 'Pole :attribute musi być ciągiem znaków.',
    'timezone' => 'Pole :attribute musi zawierać prawidłową strefę czasową.',
    'unique' => ':attribute został już zajęty.',
    'uploaded' => 'Nie udało się przesłać atrybutu :attribute.',
    'uppercase' => 'Pole :attribute musi być pisane wielkimi literami.',
    'url' => 'Pole :attribute musi być prawidłowym adresem URL.',
    'ulid' => 'Pole :attribute musi być prawidłowym identyfikatorem ULID.',
    'uuid' => 'Pole :attribute musi być prawidłowym identyfikatorem UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
