<?php
$exports = <<<'JSON'
{
  "name": "ConnCS",
  "module": "dbconnector",
  "action": "connect",
  "options": {
    "server": "mysql",
    "databaseType": "MySQL",
    "connectionString": "mysql:host=localhost;sslverify=false;dbname=mindfuli_expense;user=root;password=Sanjay@123;charset=utf8",
    "meta": {
      "allTables": [
        "account_master",
        "account_transaction",
        "borrowed_master",
        "categories",
        "collections",
        "collection_type",
        "expense",
        "form_data",
        "form_fields",
        "form_master",
        "form_values",
        "lic_master",
        "lic_premiums",
        "loan_details",
        "loan_master",
        "sub_categories",
        "target_master",
        "target_transaction",
        "theme",
        "user",
        "userlogged",
        "user_type"
      ],
      "allViews": [],
      "tables": {
        "user": {
          "columns": {
            "id": {
              "type": "int",
              "primary": true
            },
            "first_name": {
              "type": "varchar",
              "size": 20
            },
            "last_name": {
              "type": "varchar",
              "size": 20
            },
            "username": {
              "type": "varchar",
              "size": 255
            },
            "email": {
              "type": "varchar",
              "size": 50
            },
            "password": {
              "type": "varchar",
              "size": 100
            },
            "mobile": {
              "type": "varchar",
              "size": 255
            },
            "user_type": {
              "type": "int"
            },
            "profile_pic": {
              "type": "varchar",
              "size": 255
            },
            "status": {
              "type": "tinyint"
            },
            "deleted": {
              "type": "tinyint"
            },
            "created_at": {
              "type": "date"
            },
            "updated_at": {
              "type": "date"
            }
          }
        },
        "expense": {
          "columns": {
            "id": {
              "type": "int",
              "primary": true
            },
            "user_id": {
              "type": "int"
            },
            "category_id": {
              "type": "int"
            },
            "invoice_number": {
              "type": "int",
              "nullable": true,
              "defaultValue": "NULL"
            },
            "quantity": {
              "type": "decimal"
            },
            "unit": {
              "type": "int"
            },
            "purchase_date": {
              "type": "date"
            },
            "receipt_url": {
              "type": "varchar",
              "size": 255,
              "nullable": true,
              "defaultValue": "NULL"
            },
            "receipt_name": {
              "type": "varchar",
              "size": 255,
              "nullable": true,
              "defaultValue": "NULL"
            },
            "account": {
              "type": "int",
              "nullable": true,
              "defaultValue": "NULL"
            },
            "payment_type": {
              "type": "int",
              "nullable": true,
              "defaultValue": "NULL"
            },
            "remark": {
              "type": "text",
              "size": 65535,
              "nullable": true,
              "defaultValue": "NULL"
            },
            "amount": {
              "type": "decimal"
            },
            "deleted": {
              "type": "tinyint"
            },
            "invoice_name": {
              "type": "varchar",
              "size": 255,
              "nullable": true,
              "defaultValue": "NULL"
            },
            "created_on": {
              "type": "datetime",
              "defaultValue": "current_timestamp()"
            }
          }
        },
        "categories": {
          "columns": {
            "id": {
              "type": "int",
              "primary": true
            },
            "category_name": {
              "type": "varchar",
              "size": 50
            },
            "status": {
              "type": "enum",
              "size": 8,
              "defaultValue": "'Active'"
            },
            "deleted": {
              "type": "tinyint",
              "defaultValue": "0"
            },
            "created_at": {
              "type": "timestamp",
              "defaultValue": "current_timestamp()"
            },
            "updated_at": {
              "type": "timestamp",
              "defaultValue": "'0000-00-00 00:00:00'"
            }
          }
        },
        "sub_categories": {
          "columns": {
            "id": {
              "type": "int",
              "primary": true
            },
            "category_id": {
              "type": "int"
            },
            "subcategory_name": {
              "type": "varchar",
              "size": 50
            },
            "default_price": {
              "type": "decimal",
              "nullable": true,
              "defaultValue": "NULL"
            },
            "default_unit": {
              "type": "int",
              "nullable": true,
              "defaultValue": "NULL"
            },
            "status": {
              "type": "enum",
              "size": 8,
              "defaultValue": "'Active'"
            },
            "deleted": {
              "type": "tinyint",
              "defaultValue": "0"
            },
            "created_at": {
              "type": "timestamp",
              "defaultValue": "current_timestamp()"
            },
            "updated_at": {
              "type": "timestamp",
              "defaultValue": "current_timestamp()"
            }
          }
        },
        "collections": {
          "columns": {
            "id": {
              "type": "int",
              "primary": true
            },
            "collectiontype_id": {
              "type": "int"
            },
            "name": {
              "type": "varchar",
              "size": 50
            },
            "deleted": {
              "type": "tinyint",
              "defaultValue": "0"
            }
          }
        },
        "account_master": {
          "columns": {
            "id": {
              "type": "int",
              "primary": true
            },
            "userid": {
              "type": "int",
              "nullable": true,
              "defaultValue": "NULL"
            },
            "account_owner": {
              "type": "int"
            },
            "account_number": {
              "type": "bigint",
              "nullable": true,
              "defaultValue": "NULL"
            },
            "CRN": {
              "type": "int",
              "nullable": true,
              "defaultValue": "NULL"
            },
            "card_limit": {
              "type": "int",
              "nullable": true,
              "defaultValue": "NULL"
            },
            "bank_name": {
              "type": "varchar",
              "size": 50,
              "nullable": true,
              "defaultValue": "NULL"
            },
            "ifsc_code": {
              "type": "varchar",
              "size": 50,
              "nullable": true,
              "defaultValue": "NULL"
            },
            "address": {
              "type": "varchar",
              "size": 255,
              "nullable": true,
              "defaultValue": "NULL"
            },
            "type": {
              "type": "int"
            },
            "status": {
              "type": "int"
            }
          }
        },
        "account_transaction": {
          "columns": {
            "id": {
              "type": "int",
              "primary": true
            },
            "account_id": {
              "type": "int"
            },
            "credit": {
              "type": "decimal",
              "nullable": true,
              "defaultValue": "NULL"
            },
            "debit": {
              "type": "decimal",
              "nullable": true,
              "defaultValue": "NULL"
            },
            "date_of_transaction": {
              "type": "date"
            },
            "expense_id": {
              "type": "int",
              "nullable": true,
              "defaultValue": "NULL"
            },
            "type": {
              "type": "int",
              "nullable": true,
              "defaultValue": "NULL"
            },
            "from_account": {
              "type": "int",
              "nullable": true,
              "defaultValue": "NULL"
            },
            "to_account": {
              "type": "int",
              "nullable": true,
              "defaultValue": "NULL"
            },
            "transaction_detail": {
              "type": "varchar",
              "size": 255,
              "nullable": true,
              "defaultValue": "NULL"
            },
            "created_at": {
              "type": "datetime",
              "defaultValue": "current_timestamp()"
            },
            "deleted": {
              "type": "tinyint"
            }
          }
        },
        "form_master": {
          "columns": {
            "form_id": {
              "type": "int",
              "primary": true
            },
            "form_name": {
              "type": "varchar",
              "size": 255
            },
            "form_description": {
              "type": "text",
              "size": 65535,
              "nullable": true,
              "defaultValue": "NULL"
            },
            "form_instructions": {
              "type": "text",
              "size": 65535,
              "nullable": true,
              "defaultValue": "NULL"
            },
            "form_logo": {
              "type": "varchar",
              "size": 255,
              "nullable": true,
              "defaultValue": "NULL"
            },
            "grid_size": {
              "type": "varchar",
              "size": 50,
              "defaultValue": "'col-lg-4'"
            },
            "is_edit": {
              "type": "tinyint",
              "defaultValue": "1"
            },
            "is_delete": {
              "type": "tinyint",
              "defaultValue": "1"
            },
            "is_active": {
              "type": "datetime",
              "defaultValue": "current_timestamp()"
            },
            "is_deleted": {
              "type": "datetime",
              "nullable": true,
              "defaultValue": "NULL"
            }
          }
        }
      }
    }
  }
}
JSON;
?>