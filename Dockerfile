from python:2-alpine


RUN mkdir -p /opt/
COPY web /opt/app

RUN pip install --upgrade pip
RUN pip install -r /opt/app/requirements.txt

RUN pip install gunicorn

CMD gunicorn -w 4 -b :8000 --chdir /opt/app wsgi

