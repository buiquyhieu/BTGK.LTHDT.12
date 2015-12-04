using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.IO;
using System.Data;
using System.Data.SQLite;
namespace BaiTapLonHDT
{
    class Program
    {


        static void Main(string[] args)
        {

           
            XuLy_TinhToan[] SinhVien = new XuLy_TinhToan[100];
            for (int i = 0; i < 100; i++)
            {
                SinhVien[i] = new XuLy_TinhToan();
                SinhVien[i].LayGiaTri(i + 1200);
                SinhVien[i].Tinhtoan();
                for (int j = 0; j < 4; j++)
                    if (SinhVien[i].KetQua[j] > 0)
                    {
                        string sql = "INSERT INTO nvxt VALUES('" + SinhVien[i].SoBD + "','" + (j+1) + "','" + SinhVien[i].TenNV[j] + "','" + SinhVien[i].KetQua[j] + " ')";
                        Console.WriteLine(sql);
                        SinhVien[i].Getdata(sql);
                    }
              
            }
            Console.ReadLine();
        }
    }
}