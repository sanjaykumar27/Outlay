<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      }
    ]
  },
  "exec": {
    "steps": [
      "Connections/ConnCS",
      "SecurityProviders/SecurityCS",
      {
        "name": "",
        "module": "auth",
        "action": "restrict",
        "options": {
          "provider": "SecurityCS",
          "permissions": [
            "Active"
          ],
          "loginUrl": "/./",
          "forbiddenUrl": "/./"
        }
      },
      {
        "name": "queryInvoice",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "ConnCS"
        },
        "output": true,
        "meta": [],
        "outputType": "array"
      }
    ]
  }
}
JSON
);
?>