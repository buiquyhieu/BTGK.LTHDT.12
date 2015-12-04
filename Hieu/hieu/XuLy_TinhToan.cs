
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using System.Data.SQLite;
namespace BaiTapLonHDT
{
    class XuLy_TinhToan
    {
        private string soBD, hoTen, ngaySinh, khuVuc, danToc, uuTien;
        private string[] tenNV = new string[4];
        private string[] nguyenVong = new string[4];
        private double[] diemMon = new double[13];
        private double[] ketQua = new double[4];

        public string SoBD
        {
            get { return soBD; }
        }
        public double[] KetQua
        {
            get { return ketQua; }
        }
        public string[] Nguyenvong
        {
            get { return nguyenVong; }
        }
        public string[] TenNV
        {
            get { return tenNV; }
        }
        public void LayGiaTri(int stt)
        {
            LayDuLieu sinhVien = new LayDuLieu();
            sinhVien.du_lieu(stt);
            soBD = sinhVien.SoBD;
            hoTen = sinhVien.HoTen;
            ngaySinh = sinhVien.NgaySinh;
            khuVuc = sinhVien.KhuVuc;
            danToc = sinhVien.DanToc;
            uuTien = sinhVien.UuTien;
            for (int i = 0; i < 4; i++)
            {
                tenNV[i] = sinhVien.TenNV[i];
            }
            for (int i = 0; i < 4; i++)
            {
                nguyenVong[i] = sinhVien.NguyenVong[i];
            }
            for (int i = 0; i < 13; i++)
                diemMon[i] = sinhVien.DiemMon[i];

        }
        private double D;
        private double diemTungMon(string a)
        {
            switch (a)
            {
                case "Toan": D = diemMon[0]; break;
                case "Van": D = diemMon[1]; break;
                case "Ly": D = diemMon[2]; break;
                case "Hoa": D = diemMon[3]; break;
                case "Sinh": D = diemMon[4]; break;
                case "Su": D = diemMon[5]; break;
                case "Dia": D = diemMon[6]; break;
                case "Anh": D = diemMon[7]; break;
                case "Nga": D = diemMon[8]; break;
                case "Phap": D = diemMon[9]; break;
                case "Trung": D = diemMon[10]; break;
                case "Duc": D = diemMon[11]; break;
                case "Nhat": D = diemMon[12]; break;
            }
            return D;
        }


        private double diemKhuVuc(string a)
        {
            if (a == "KV1") return 1.5;
            else if (a == "KV2-NT") return 1;
            else if (a == "KV2") return 0;
            else return 0;
        }

        private double diemUuTien(string a)
        {
            if (a == "UT") return 1;
            else return 0;
        }

        private double diemDanToc(string a)
        {
            if (a == "NDT1") return 2;
            else if (a == "NDT2") return 1;
            else return 0;
        }

        public void Tinhtoan()
        {
            for (int i = 0; i < 4; i++)
            {
                if (nguyenVong[i] == null) ketQua[i] = -1;
                else
                {
                    string[] Z = nguyenVong[i].Split(',');
                    if (Z[3] == "1")
                        ketQua[i] = (2 * diemTungMon(Z[0]) + diemTungMon(Z[1]) + diemTungMon(Z[2])) / 4 + (diemKhuVuc(khuVuc) + diemDanToc(danToc)) / 3 + diemUuTien(uuTien);
                    else ketQua[i] = (diemTungMon(Z[0]) + diemTungMon(Z[1]) + diemTungMon(Z[2])) / 3 + (diemKhuVuc(khuVuc) + diemDanToc(danToc)) / 3 + diemUuTien(uuTien);
                }
            }
        }
        public void Getdata(string sql)
        {
            SQLiteConnection conn = new SQLiteConnection(@"Data Source =Hieu.db");
            conn.Open();


            SQLiteCommand cmd; //Đối tượng thuộc lớp SqlCommand
            cmd = new SQLiteCommand();
            cmd.Connection = conn; //Gán kết nối
            //string sql = "INSERT INTO ketqua VALUES('test2',1)";


            cmd.CommandText = sql; //Gán lệnh SQL
            try
            {
                cmd.ExecuteNonQuery(); //Thực hiện câu lệnh SQL
            }
            catch (Exception ex)
            {
                Console.Write("Loi");
            }
            cmd.Dispose();//Giải phóng bộ nhớ
            cmd = null;
        }

    }
}
