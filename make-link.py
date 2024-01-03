"""
This is just used to create a link document for my website.

Eventually I'd like to look into replacing this with Raindrop and using their API, but today is not that day
"""
import json
import requests
import datetime

def is_valid(url: str) -> bool:
    try:
        res = requests.get(url)
        return res.status_code != 404
    except:
        return False

if __name__ == "__main__":
    data = {}    

    url = input("URL: ")

    if not is_valid(url):
        print("URL was not valid. Link not created.")
        exit(1)

    data['url'] = url

    data['title'] = input("Title: ") 

    tags = input("Tags (comma seperated): ")
    data['tags'] = [tag.strip() for tag in tags.split(",")]

    draft = input("Draft? [yN]: ")
    data['draft'] = True if draft else False

    slug = input("Slug? [N]: ")
    slug = slug if slug else False
    if slug:
        data['slug'] = slug

    data['time'] = "{:%Y-%m-%d %H:%M:%S}".format(datetime.datetime.now()).replace(" ", "T")

    print(json.dumps(data, indent=4))
