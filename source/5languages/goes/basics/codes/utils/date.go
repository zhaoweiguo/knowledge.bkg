package util

import "time"

func test() {
    date := time.Now()
    if date.Format("MST") == "UTC" {
        date = date.Add(time.Hour * 8)
    }


}


