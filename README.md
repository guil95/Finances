# Finances

```bash
git clone https://github.com/guil95/Finances.git
cd Finances/docker
docker-compose up
sudo nano /etc/hosts and add 127.0.0.1 finances.local
```
# Routes
```
[POST] http://finances.local/finances
[DELETE] http://finances.local/finances/{id}
[GET] http://finances.local/finances/{id}
[GET] http://finances.local/finances/{id}/installments
```

# Payloads
`
 [POST] http://finances.local/finances
 If paidInCash equals 1, the total installations and the downPayment will be irrelevant, but the total installations must be >= 1
`
```json
{
  "description": "Description",	
  "value": 1200,
  "type": 2,
  "totalInstallments": 1,
  "downPayment": 0,
  "paidInCash": 1
}

```
