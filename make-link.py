"""
This is just used to create a link document for my website.

Eventually I'd like to look into replacing this with Raindrop and using their API, but today is not that day
"""
import json
import requests
import datetime
from slugify import slugify


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

    data["url"] = url

    title = input("Title: ").strip()
    data["title"] = title

    tags = input("Tags (comma seperated): ")
    data["tags"] = list(set(tag.strip() for tag in tags.split(",") if tag.strip() != ""))

    draft = input("Draft? [yN]: ")
    data["isDraft"] = True if draft else False

    slug = input("Slug? [N]: ")
    slug = slugify(slug) if slug else None
    if slug:
        data["slug"] = slug

    data["publishDate"] = "{:%Y-%m-%d %H:%M:%S}".format(datetime.datetime.now()).replace(
        " ", "T"
    )

    filename = f"{slug if slug else slugify(title)}.json"

    print(f"Generating {filename}")

    with open(f"src/content/links/{filename}", "w") as file:
        file.write(json.dumps(data, indent=4))

    print("Complete")
