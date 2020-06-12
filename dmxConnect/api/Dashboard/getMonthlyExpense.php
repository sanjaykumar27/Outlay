<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "settings": {
    "options": {}
  },
  "meta": {
    "options": {}
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
          ]
        }
      },
      {
        "name": "monthlyExpense",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "query": "SELECT `id`, SUM(amount) as amount, DATE_FORMAT(purchase_date, \"%M %Y\") as dates FROM `expense` GROUP BY MONTH(purchase_date), YEAR(purchase_date) ORDER BY `expense`.`id` ASC LIMIT 12",
            "params": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "id",
            "type": "number"
          },
          {
            "name": "amount",
            "type": "text"
          },
          {
            "name": "dates",
            "type": "text"
          }
        ],
        "outputType": "array"
      }
    ]
  }
}
JSON
);
?>