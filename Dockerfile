from python:2-alpine

EXPOSE 8000

RUN pip install --upgrade pip
RUN pip install gunicorn
RUN pip install Flask==0.10.1
RUN pip install itsdangerous==0.24
RUN pip install Jinja2==2.8
RUN pip install MarkupSafe==0.23
RUN pip install Werkzeug==0.11.3
RUN pip install wheel==0.24.0

RUN mkdir -p /opt/
COPY web /opt/app


CMD gunicorn -w 4 -b :8000 --chdir /opt/app wsgi

