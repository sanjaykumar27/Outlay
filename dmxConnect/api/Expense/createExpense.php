<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "settings": {
    "options": {}
  },
  "meta": {
    "options": {
      "linkedFile": "/Expense/spa_createExpense.php",
      "linkedForm": "CreateExpense"
    },
    "$_POST": [
      {
        "type": "number",
        "fieldName": "InvoiceNumber",
        "options": {
          "rules": {
            "core:number": {}
          }
        },
        "name": "InvoiceNumber"
      },
      {
        "type": "text",
        "fieldName": "InvoiceName",
        "name": "InvoiceName"
      },
      {
        "type": "date",
        "fieldName": "PurchaseDate",
        "options": {
          "rules": {
            "core:date": {}
          }
        },
        "name": "PurchaseDate"
      },
      {
        "type": "text",
        "fieldName": "Remark",
        "name": "Remark"
      },
      {
        "type": "file",
        "fieldName": "target_photo",
        "options": {
          "rules": {}
        },
        "name": "target_photo",
        "sub": [
          {
            "type": "text",
            "name": "name"
          },
          {
            "type": "text",
            "name": "type"
          },
          {
            "type": "number",
            "name": "size"
          },
          {
            "type": "text",
            "name": "error"
          },
          {
            "type": "text",
            "name": "name"
          },
          {
            "type": "text",
            "name": "type"
          },
          {
            "type": "number",
            "name": "size"
          },
          {
            "type": "text",
            "name": "error"
          },
          {
            "type": "text",
            "name": "name"
          },
          {
            "type": "text",
            "name": "type"
          },
          {
            "type": "number",
            "name": "size"
          },
          {
            "type": "text",
            "name": "error"
          },
          {
            "name": "name",
            "type": "text"
          },
          {
            "name": "type",
            "type": "text"
          },
          {
            "name": "size",
            "type": "number"
          },
          {
            "name": "error",
            "type": "text"
          }
        ],
        "outputType": "file"
      },
      {
        "type": "number",
        "fieldName": "Quantity[]",
        "multiple": true,
        "options": {
          "rules": {
            "core:number": {}
          }
        },
        "name": "Quantity"
      },
      {
        "type": "number",
        "fieldName": "Amount[]",
        "multiple": true,
        "options": {
          "rules": {
            "core:number": {}
          }
        },
        "name": "Amount"
      },
      {
        "type": "text",
        "fieldName": "AccountID",
        "name": "AccountID"
      },
      {
        "type": "text",
        "fieldName": "PaymentMethod",
        "name": "PaymentMethod"
      },
      {
        "type": "text",
        "fieldName": "ItemID[]",
        "multiple": true,
        "name": "ItemID"
      },
      {
        "type": "text",
        "fieldName": "UnitID[]",
        "multiple": true,
        "name": "UnitID"
      },
      {
        "type": "array",
        "name": "record",
        "sub": [
          {
            "type": "number",
            "name": "$parent"
          },
          {
            "type": "number",
            "name": "category_id"
          },
          {
            "type": "number",
            "name": "invoice_number"
          },
          {
            "type": "text",
            "name": "invoice_name"
          },
          {
            "type": "number",
            "name": "quantity"
          },
          {
            "type": "number",
            "name": "unit"
          },
          {
            "type": "date",
            "name": "purchase_date"
          },
          {
            "type": "text",
            "name": "receipt_url"
          },
          {
            "type": "text",
            "name": "receipt_name"
          },
          {
            "type": "number",
            "name": "account"
          },
          {
            "type": "number",
            "name": "payment_type"
          },
          {
            "type": "text",
            "name": "remark"
          },
          {
            "type": "number",
            "name": "amount"
          },
          {
            "type": "number",
            "name": "deleted"
          },
          {
            "type": "number",
            "name": "$_POST"
          },
          {
            "type": "number",
            "name": "$value"
          },
          {
            "type": "number",
            "name": "insertExpense"
          },
          {
            "type": "datetime",
            "name": "NOW"
          }
        ]
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
        "name": "upload1",
        "module": "upload",
        "action": "upload",
        "options": {
          "fields": "{{$_POST.target_photo}}",
          "path": "/assets/uploads",
          "template": "{guid}{ext}",
          "replaceSpace": true
        },
        "meta": [
          {
            "name": "name",
            "type": "text"
          },
          {
            "name": "path",
            "type": "text"
          },
          {
            "name": "url",
            "type": "text"
          },
          {
            "name": "type",
            "type": "text"
          },
          {
            "name": "size",
            "type": "text"
          },
          {
            "name": "error",
            "type": "number"
          }
        ],
        "outputType": "file"
      },
      {
        "name": "repeat1",
        "module": "core",
        "action": "repeat",
        "options": {
          "repeat": "{{$_POST.ItemID}}",
          "exec": {
            "steps": [
              {
                "name": "insertExpense",
                "module": "dbupdater",
                "action": "insert",
                "options": {
                  "connection": "ConnCS",
                  "sql": {
                    "type": "insert",
                    "values": [
                      {
                        "table": "expense",
                        "column": "user_id",
                        "type": "number",
                        "value": "{{$parent.SecurityCS.identity}}"
                      },
                      {
                        "table": "expense",
                        "column": "category_id",
                        "type": "number",
                        "value": "{{$value}}"
                      },
                      {
                        "table": "expense",
                        "column": "invoice_number",
                        "type": "number",
                        "value": "{{$_POST.InvoiceNumber}}"
                      },
                      {
                        "table": "expense",
                        "column": "invoice_name",
                        "type": "text",
                        "value": "{{$_POST.InvoiceName}}"
                      },
                      {
                        "table": "expense",
                        "column": "quantity",
                        "type": "number",
                        "value": "{{$_POST.Quantity[$key]}}"
                      },
                      {
                        "table": "expense",
                        "column": "unit",
                        "type": "number",
                        "value": "{{$_POST.UnitID[$key]}}"
                      },
                      {
                        "table": "expense",
                        "column": "purchase_date",
                        "type": "date",
                        "value": "{{$_POST.PurchaseDate}}"
                      },
                      {
                        "table": "expense",
                        "column": "receipt_url",
                        "type": "text",
                        "value": "{{$_POST.target_photo.name}}"
                      },
                      {
                        "table": "expense",
                        "column": "receipt_name",
                        "type": "text",
                        "value": "{{receipt_name}}"
                      },
                      {
                        "table": "expense",
                        "column": "account",
                        "type": "number",
                        "value": "{{$_POST.AccountID}}"
                      },
                      {
                        "table": "expense",
                        "column": "payment_type",
                        "type": "number",
                        "value": "{{$_POST.PaymentMethod}}"
                      },
                      {
                        "table": "expense",
                        "column": "remark",
                        "type": "text",
                        "value": "{{$_POST.Remark}}"
                      },
                      {
                        "table": "expense",
                        "column": "amount",
                        "type": "number",
                        "value": "{{$_POST.Amount[$key]}}"
                      }
                    ],
                    "table": "expense",
                    "query": "INSERT INTO expense\n(user_id, category_id, invoice_number, invoice_name, quantity, unit, purchase_date, receipt_url, receipt_name, account, payment_type, remark, amount) VALUES (:P1 /* {{$parent.SecurityCS.identity}} */, :P2 /* {{$value}} */, :P3 /* {{$_POST.InvoiceNumber}} */, :P4 /* {{$_POST.InvoiceName}} */, :P5 /* {{$_POST.Quantity[$key]}} */, :P6 /* {{$_POST.UnitID[$key]}} */, :P7 /* {{$_POST.PurchaseDate}} */, :P8 /* {{$_POST.target_photo.name}} */, :P9 /* {{receipt_name}} */, :P10 /* {{$_POST.AccountID}} */, :P11 /* {{$_POST.PaymentMethod}} */, :P12 /* {{$_POST.Remark}} */, :P13 /* {{$_POST.Amount[$key]}} */)",
                    "params": [
                      {
                        "name": ":P1",
                        "type": "expression",
                        "value": "{{$parent.SecurityCS.identity}}"
                      },
                      {
                        "name": ":P2",
                        "type": "expression",
                        "value": "{{$value}}"
                      },
                      {
                        "name": ":P3",
                        "type": "expression",
                        "value": "{{$_POST.InvoiceNumber}}"
                      },
                      {
                        "name": ":P4",
                        "type": "expression",
                        "value": "{{$_POST.InvoiceName}}"
                      },
                      {
                        "name": ":P5",
                        "type": "expression",
                        "value": "{{$_POST.Quantity[$key]}}"
                      },
                      {
                        "name": ":P6",
                        "type": "expression",
                        "value": "{{$_POST.UnitID[$key]}}"
                      },
                      {
                        "name": ":P7",
                        "type": "expression",
                        "value": "{{$_POST.PurchaseDate}}"
                      },
                      {
                        "name": ":P8",
                        "type": "expression",
                        "value": "{{$_POST.target_photo.name}}"
                      },
                      {
                        "name": ":P9",
                        "type": "expression",
                        "value": "{{receipt_name}}"
                      },
                      {
                        "name": ":P10",
                        "type": "expression",
                        "value": "{{$_POST.AccountID}}"
                      },
                      {
                        "name": ":P11",
                        "type": "expression",
                        "value": "{{$_POST.PaymentMethod}}"
                      },
                      {
                        "name": ":P12",
                        "type": "expression",
                        "value": "{{$_POST.Remark}}"
                      },
                      {
                        "name": ":P13",
                        "type": "expression",
                        "value": "{{$_POST.Amount[$key]}}"
                      }
                    ]
                  }
                },
                "meta": [
                  {
                    "name": "identity",
                    "type": "text"
                  },
                  {
                    "name": "affected",
                    "type": "number"
                  }
                ]
              },
              {
                "name": "insertAccountTransaction",
                "module": "dbupdater",
                "action": "insert",
                "options": {
                  "connection": "ConnCS",
                  "sql": {
                    "type": "insert",
                    "values": [
                      {
                        "table": "account_transaction",
                        "column": "account_id",
                        "type": "number",
                        "value": "{{$_POST.AccountID}}"
                      },
                      {
                        "table": "account_transaction",
                        "column": "debit",
                        "type": "number",
                        "value": "{{$_POST.Amount[$key]}}"
                      },
                      {
                        "table": "account_transaction",
                        "column": "date_of_transaction",
                        "type": "date",
                        "value": "{{$_POST.PurchaseDate}}"
                      },
                      {
                        "table": "account_transaction",
                        "column": "expense_id",
                        "type": "number",
                        "value": "{{insertExpense.identity}}"
                      },
                      {
                        "table": "account_transaction",
                        "column": "type",
                        "type": "number",
                        "value": "{{$_POST.PaymentMethod}}"
                      },
                      {
                        "table": "account_transaction",
                        "column": "transaction_detail",
                        "type": "text",
                        "value": "Expense Transaction"
                      },
                      {
                        "table": "account_transaction",
                        "column": "created_at",
                        "type": "datetime",
                        "value": "{{NOW}}"
                      }
                    ],
                    "table": "account_transaction",
                    "query": "INSERT INTO account_transaction\n(account_id, debit, date_of_transaction, expense_id, type, transaction_detail, created_at) VALUES (:P1 /* {{$_POST.AccountID}} */, :P2 /* {{$_POST.Amount[$key]}} */, :P3 /* {{$_POST.PurchaseDate}} */, :P4 /* {{insertExpense.identity}} */, :P5 /* {{$_POST.PaymentMethod}} */, 'Expense Transaction', :P6 /* {{NOW}} */)",
                    "params": [
                      {
                        "name": ":P1",
                        "type": "expression",
                        "value": "{{$_POST.AccountID}}"
                      },
                      {
                        "name": ":P2",
                        "type": "expression",
                        "value": "{{$_POST.Amount[$key]}}"
                      },
                      {
                        "name": ":P3",
                        "type": "expression",
                        "value": "{{$_POST.PurchaseDate}}"
                      },
                      {
                        "name": ":P4",
                        "type": "expression",
                        "value": "{{insertExpense.identity}}"
                      },
                      {
                        "name": ":P5",
                        "type": "expression",
                        "value": "{{$_POST.PaymentMethod}}"
                      },
                      {
                        "name": ":P6",
                        "type": "expression",
                        "value": "{{NOW}}"
                      }
                    ]
                  }
                },
                "meta": [
                  {
                    "name": "identity",
                    "type": "text"
                  },
                  {
                    "name": "affected",
                    "type": "number"
                  }
                ]
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "$index",
            "type": "number"
          },
          {
            "name": "$number",
            "type": "number"
          },
          {
            "name": "$name",
            "type": "text"
          },
          {
            "name": "$value",
            "type": "object"
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