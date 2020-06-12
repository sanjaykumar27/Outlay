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
        }
      ],
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
  }
});
