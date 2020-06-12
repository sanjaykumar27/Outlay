<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "settings": {
    "options": {}
  },
  "meta": {
    "options": {},
    "$_GET": [
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      },
      {
        "type": "text",
        "name": "categoryid"
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
          ]
        }
      },
      {
        "name": "getItems",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "sub_categories",
                "column": "id"
              },
              {
                "table": "sub_categories",
                "column": "subcategory_name"
              }
            ],
            "table": {
              "name": "sub_categories"
            },
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "sub_categories.deleted",
                  "field": "sub_categories.deleted",
                  "type": "double",
                  "operator": "equal",
                  "value": 0,
                  "data": {
                    "table": "sub_categories",
                    "column": "deleted",
                    "type": "number"
                  },
                  "operation": "="
                },
                {
                  "condition": "AND",
                  "rules": [
                    {
                      "id": "sub_categories.category_id",
                      "field": "sub_categories.category_id",
                      "type": "double",
                      "operator": "equal",
                      "value": "{{$_GET.categoryid}}",
                      "data": {
                        "table": "sub_categories",
                        "column": "category_id",
                        "type": "number"
                      },
                      "operation": "="
                    }
                  ],
                  "conditional": "{{$_GET.categoryid}}"
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT id, subcategory_name\nFROM sub_categories\nWHERE deleted = 0 AND (category_id = :P1 /* {{$_GET.categoryid}} */)\nORDER BY subcategory_name ASC",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.categoryid}}"
              }
            ],
            "orders": [
              {
                "table": "sub_categories",
                "column": "subcategory_name",
                "direction": "ASC"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "id",
            "type": "number"
          },
          {
            "name": "subcategory_name",
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