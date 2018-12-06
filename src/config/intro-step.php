<?php

return [
    "web_middleware" => ["web","auth"],
    "api_middleware" => ["web", "auth"],
    "user_table" => "users",
    "user_column" => "user_id",
    "user_model" => "\\App\\User"
];