<?php

// Sessija tiek attiestatīta un izslēgta
session_start();
session_unset();
session_destroy();

// Lietotājs tiek novirzīts atpakaļ galvenajā mājaslapas sadaļā
header("location: ../index.php");
exit();