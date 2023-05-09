<label for="{{ $randomId }}">{{ $label }}</label>
<input type="email" id="{{ $randomId }}" name="{{ $name }}" value="{{ $value }}" />


<?php
    $db_dbname = 'web';
    $db_user = 'php';
    $db_password = 'php';

file_put_contents('lib/config.php', '<?php'."\n\n".'$db_user = \''.$db_user.'\';'."\n".'$db_password = \''.$db_password.'\';'."\n".'$db_dbname = \''.$db_dbname.'\';'."\n");

