# Lead
### List of leads, statuses and statistics:
- Method: GET
- Route: http://127.0.0.1:8000/leads/get
- Response Body Example:

```json
{
    "leads": [
        {
            "id": 1,
            "name": "asdziwavaz",
            "surname": "asdziwavaz",
            "phone": "47345345",
            "email": "asdziwavaz@mailinator.com",
            "text": "Quidem veritatis qui",
            "status_id": 1,
            "created_at": "2024-08-21T04:46:49.000000Z",
            "updated_at": "2024-08-22T10:58:14.000000Z",
            "isDisabled": true
        },
        {
            "id": 2,
            "name": "ziwavaz",
            "surname": "ziwavaz",
            "phone": "75234234242",
            "email": "ziwavaz@mailinator.com",
            "text": "Obcaecati odit aliqu",
            "status_id": 3,
            "created_at": "2024-08-22T10:37:32.000000Z",
            "updated_at": "2024-08-22T10:58:42.000000Z",
            "isDisabled": true
        }
    ],
    "countAllLeads": 2,
    "countLeadsInStatusNew": 1,
    "countLeadsInStatusAtWork": 0,
    "countLeadsInStatusCompleted": 1,
    "statuses": [
        {
            "id": 1,
            "name": "Новый"
        },
        {
            "id": 2,
            "name": "В работе"
        },
        {
            "id": 3,
            "name": "Завершен"
        }
    ]
}
```

### Create lead:
- Method: POST
- Route: http://127.0.0.1:8000/leads
- Headers:
```
X-CSRF-TOKEN: plL58tpoWssOzdcCFgv8fZsqrJDAfXYsIST39FZU
```
- Request Body:
```json
{
    "name": "Test",
    "surname": "Test",
    "phone": "12345678",
    "email": "test@mail.ru",
    "text": "test text"
}
```
- Response Body Example:
```
200 OK
```
