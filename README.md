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
