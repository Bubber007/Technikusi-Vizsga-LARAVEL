# Aszteroida bányászat - Backend Feladatsor

- **GET /asteroids** – Listázza az összes aszteroidát.
    - A visszaadtott adatok között ne szerepeljen semmilyen id mező! Az adatok legyenek rendezve az aszteroida felfedezésének dátuma szerint! Hozzon létre egy extra mezőt index néven amelyben az egyes aszteroidák számozva vannak 1-től kezdődően. Minden aszteroidához jelenjen meg az ott bányászati tevékenységet folytató bányászati cég, valamint a műveleti vezető neve!

- **POST /asteroids** – Új aszteroida hozzáadása. Validáljon minden kötelező mezőt! A corporation_id létezzen a mining_corporations táblában!
  - Példa body:
    ```json
    {
        "name": "Apophis",
        "corporation_id": 1,
        "discovered_date": "2004-06-19",
        "mineral_content": "Gold"
    }
    ```

- **DELETE /asteroids/{id}** – Egy adott aszteroida törlése. Ha nem lézetik az aszteroida, akkor adjon vissza 404-et és a hibára vonatkozó üzenetet! Ha az aszteroidához tartozik műveleti vezető és emiatt nem törölhető akkor adjon vissza 403-at! Sikeres törlés esetén adjon vissza 200-at és megfelelő üzenetet!

- **GET /asteroids/discovered-after/{year}** – Az adott év után felfedezett aszteroidák listázása.

- **GET  /corporations/stat** - Határozza meg, hogy az egyes cégek hány aszteroidán folytatnak bányászati tevékeséget!