<?php
$exports = <<<'JSON'
{
  "name": "SecurityCS",
  "module": "auth",
  "action": "provider",
  "options": {
    "secret": "Dh85yPZ7d5MCjNK",
    "provider": "Database",
    "connection": "ConnCS",
    "users": {
      "table": "user",
      "identity": "id",
      "username": "email",
      "password": "password"
    },
    "permissions": {
      "Active": {
        "table": "user",
        "identity": "id",
        "conditions": []
      }
    }
  },
  "meta": [
    {
      "name": "identity",
      "type": "text"
    }
  ]
}
JSON;
?>