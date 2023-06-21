import time

import selenium
from selenium import webdriver
from selenium.webdriver import DesiredCapabilities
from selenium.webdriver.common.by import By
from selenium.webdriver.remote.webelement import WebElement
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.firefox.options import Options
from selenium.webdriver.common.keys import Keys

SIGN_IN_URL = "http://localhost/se"
COMMENT = "This is a test"


def test_review():
    c = Options()
    # adding headless parameter to webdriver object
    # c.add_argument("--headless")

    browser = webdriver.Firefox(executable_path=r"C:\Windows\geckodriver.exe", options=c)
    wait = WebDriverWait(browser, 10)

    browser.get(SIGN_IN_URL)

    # Shawshank
    view_details_button = wait.until(EC.element_to_be_clickable((By.XPATH, '/html/body/main/div[1]/div/div[2]/div/div[1]/div/div[2]/button')))
    view_details_button.click()

    leave_review_button = wait.until(EC.element_to_be_clickable((By.XPATH, '/html/body/div[4]/div/div/form/div[3]/button')))
    leave_review_button.click()

    comment_field = wait.until(EC.element_to_be_clickable((By.XPATH, '//*[@id="reviewComment"]')))
    comment_field.send_keys(COMMENT)

    submit_button = wait.until(EC.element_to_be_clickable((By.XPATH, '/html/body/div[5]/div/div/div[2]/form/button')))
    submit_button.click()

    time.sleep(3)


    source = browser.page_source

    assert COMMENT in source



test_review()