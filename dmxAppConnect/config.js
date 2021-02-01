dmx.config({
  "ExpenseList": {
    "query": [
      {
        "type": "text",
        "name": "offset"
      },
      {
        "type": "text",
        "name": "dir"
      },
      {
        "type": "text",
        "name": "sort"
      }
    ],
    "repeat1": {
      "meta": [
        {
          "name": "invoice_number",
          "type": "number"
        },
        {
          "name": "quantity",
          "type": "number"
        },
        {
          "name": "purchase_date",
          "type": "date"
        },
        {
          "name": "receipt_name",
          "type": "text"
        },
        {
          "name": "receipt_url",
          "type": "text"
        },
        {
          "name": "account",
          "type": "number"
        },
        {
          "name": "payment_type",
          "type": "number"
        },
        {
          "name": "remark",
          "type": "text"
        },
        {
          "name": "amount",
          "type": "number"
        },
        {
          "name": "ItemName",
          "type": "text"
        },
        {
          "name": "Unit",
          "type": "text"
        },
        {
          "name": "PaymentType",
          "type": "text"
        },
        {
          "name": "Expense_ID",
          "type": "number"
        },
        {
          "name": "unitid",
          "type": "number"
        },
        {
          "name": "category_id",
          "type": "number"
        },
        {
          "name": "invoice_name",
          "type": "text"
        }
      ],
      "outputType": "array"
    },
    "varItems": {
      "meta": null,
      "outputType": "text"
    },
    "varCategoryIDs": {
      "meta": null,
      "outputType": "text"
    },
    "varItemIDs": {
      "meta": null,
      "outputType": "text"
    },
    "arrItemIDs": {
      "outputType": "array"
    },
    "arrCategoryIDs": {
      "outputType": "array"
    }
  },
  "TargetList": {
    "repeattargets": {
      "meta": [
        {
          "name": "id",
          "type": "number"
        },
        {
          "name": "target_name",
          "type": "text"
        },
        {
          "name": "target_amount",
          "type": "number"
        },
        {
          "name": "target_description",
          "type": "text"
        },
        {
          "name": "target_photo",
          "type": "text"
        },
        {
          "name": "IsCompleted",
          "type": "number"
        },
        {
          "name": "CreatedOn",
          "type": "datetime"
        }
      ],
      "outputType": "array"
    }
  },
  "CreateExpense": {
    "repeat1": {
      "meta": null,
      "outputType": "number"
    }
  },
  "Items": {
    "query": [
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
        "name": "offset"
      }
    ],
    "repeatCategories": {
      "meta": [
        {
          "name": "CategoryID",
          "type": "number"
        },
        {
          "name": "CategoryName",
          "type": "text"
        },
        {
          "name": "queryItems",
          "type": "array",
          "sub": [
            {
              "name": "ItemName",
              "type": "text"
            },
            {
              "name": "ItemID",
              "type": "number"
            }
          ]
        }
      ],
      "outputType": "array"
    },
    "repeat1": {
      "meta": [
        {
          "name": "ItemName",
          "type": "text"
        },
        {
          "name": "ItemID",
          "type": "number"
        }
      ],
      "outputType": "array"
    }
  },
  "index": {
    "repeatmostpurchaseditem": {
      "meta": [
        {
          "name": "total",
          "type": "text"
        },
        {
          "name": "subcategory_name",
          "type": "text"
        },
        {
          "name": "category_name",
          "type": "text"
        }
      ],
      "outputType": "array"
    }
  },
  "AccountDetails": {
    "query": [
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
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
      }
    ],
    "repeatAccounts": {
      "meta": [
        {
          "name": "credit",
          "type": "number"
        },
        {
          "name": "debit",
          "type": "number"
        },
        {
          "name": "date_of_transaction",
          "type": "date"
        },
        {
          "name": "expense_id",
          "type": "number"
        },
        {
          "name": "from_account",
          "type": "number"
        },
        {
          "name": "to_account",
          "type": "number"
        },
        {
          "name": "transaction_detail",
          "type": "text"
        },
        {
          "name": "created_at",
          "type": "datetime"
        },
        {
          "name": "name",
          "type": "text"
        }
      ],
      "outputType": "array"
    }
  }
});
